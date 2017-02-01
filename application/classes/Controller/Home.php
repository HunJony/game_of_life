<?php defined('SYSPATH') or die('No direct script access.');

/**
 * User: Jony
 * Date: 2017. 02. 01.
 * Time: 9:21
 * Project: game_of_life
 * Company: GreenTech
 */

class Controller_Home extends Controller_Default {

	public function action_index()
	{
        $boardWidth = 10;
        $boardHeight = 10;
        $model = Model::factory('Home');
        $board = $model->createBoard($boardWidth,$boardHeight);
        $board->setCellsAliveByPattern();

        $this->view->boardWidth = $boardWidth;
        $this->view->boardHeight = $boardHeight;
        $this->view->board = $board;

        $this->view->patterns = ORM::factory("Pattern")->find_all();
	}

    public function action_ajax()
    {
        $model = Model::factory('Home');
        switch ($this->request->param('actiontarget'))
        {
            case 'index':
                switch ($this->request->param('maintarget'))
                {
                    case 'calculateNextGeneration':
                        $data = $model->calculateNextGeneration($this->request->post('boardWidth'),$this->request->post('boardHeight'),$this->request->post('aliveCells'));
                        echo json_encode($data->getCells());
                        break;

                    case 'saveActualPatternToDatabase':
                        $data = $model->saveActualPatternToDatabase($this->request->post('boardWidth'),$this->request->post('boardHeight'),$this->request->post('aliveCells'),$this->request->post('name'));
                        echo json_encode($data);
                        break;

                    case 'loadPatternFromDatabase':
                        $data = $model->loadPatternFromDatabase($this->request->post('id'));
                        echo json_encode($data);
                        break;

                    default: echo "Main target not found!";
                }
                break;

            default: echo "Action target not found!";
        }
	}
}
