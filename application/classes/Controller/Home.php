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
        $model = Model::factory('Home');
        $board = $model->createBoard(10,10);
        $board->setCellsAliveByPattern();

        $this->view->board = $board;
        //$this->view->board2 = array();
        $board2 = clone $board;
        $this->view->board2 = $board2->calculateNextGeneration();
	}
}
