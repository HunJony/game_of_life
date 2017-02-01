<?php

/**
 * User: Jony
 * Date: 2017. 02. 01.
 * Time: 9:27
 * Project: game_of_life
 * Company: GreenTech
 */
class Cell
{
    public $x = null;
    public $y = null;
    public $isAlive = null;
    public $willDie = null;
    public $willAlive = null;

    public static function factory($x,$y,$isAlive = false)
    {
        $cell = new Cell();
        $cell->x = $x;
        $cell->y = $y;
        $cell->isAlive = $isAlive;

        return $cell;
    }

    /**
     * @param bool $isAlive
     * @return $this
     */
    public function setIsAlive(bool $isAlive)
    {
        $this->isAlive = $isAlive;

        return $this;
    }

}