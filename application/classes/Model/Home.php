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


    }
}