<?php

/**
 * User: Jony
 * Date: 2017. 02. 01.
 * Time: 9:25
 * Project: game_of_life
 * Company: GreenTech
 */
class Model_Home extends Model
{
    public function createBoard($width = null, $height = null)
    {
        $board = Board::factory($width,$height);

        return $board;
    }

    public function calculateNextGeneration($boardWidth,$boardHeight,$aliveCells)
    {
        $board = $this->createBoard($boardWidth,$boardHeight);
        $board->setCellsAliveByPattern('unique',$aliveCells);

        $nextBoard = clone $board;
        return $nextBoard->calculateNextGeneration();
    }

    public function saveActualPatternToDatabase($boardWidth,$boardHeight,$aliveCells,$name)
    {
        $board = $this->createBoard($boardWidth,$boardHeight);
        $board->setCellsAliveByPattern('unique',$aliveCells);

        try {
            $pattern = ORM::factory("Pattern");
            $pattern->pat_name = $name;
            $pattern->pat_width = $boardWidth;
            $pattern->pat_height = $boardHeight;
            $pattern->pat_created_at = time();
            $pattern->save();

            foreach ($board->getCells() as $row) {
                /* @var $cell Cell */
                foreach ($row as $cell) {
                    if ($cell->isAlive) {
                        $patternPoint = ORM::factory("Pattern_Point");
                        $patternPoint->patpoi_pat_id = $pattern->pk();
                        $patternPoint->patpoi_x = $cell->x;
                        $patternPoint->patpoi_y = $cell->y;
                        $patternPoint->save();
                    }
                }
            }

            return array('error' => false, 'message' => 'Sikeres mentés!', 'id' => $pattern->pk(), 'name' => $name);
        } catch (Exception $e) {
            return array('error' => true, 'message' => 'A mentés sikertelen!', 'details' => $e->getMessage());
        }
    }

    public function loadPatternFromDatabase($id)
    {
        $pattern = ORM::factory("Pattern",$id);
        if (!$pattern->loaded()) return array('error'=>true, 'message'=>'A minta nem található!');

        return $this->getBoardDataFromPattern($pattern);
    }

    private function getBoardDataFromPattern($pattern)
    {
        $board = $this->createBoard($pattern->pat_width,$pattern->pat_height);
        $aliveCells = array();
        foreach ($pattern->points->find_all() as $point)
        {
            $aliveCells[] = array(
                'x' => $point->patpoi_x,
                'y' => $point->patpoi_y
            );
        }
        $board->setCellsAliveByPattern('unique',$aliveCells);

        return $board->getCells();
    }
}