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
    public function getActualTick()
    {

    }

    public function createBoard($width = null, $height = null)
    {
        $board = Board::factory($width,$height);

        return $board;
    }
}