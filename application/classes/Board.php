<?php

/**
 * User: Jony
 * Date: 2017. 02. 01.
 * Time: 9:29
 * Project: game_of_life
 * Company: GreenTech
 */
class Board
{
    protected $width = 50;
    protected $height = 50;
    protected $cells = array();

    public static function factory($width,$height)
    {
        $board = new Board();
        if ($width) $board->width = $width;
        if ($width) $board->height = $height;

        $board->fillBoardWithCells();

        return $board;
    }

    function __clone()
    {
        // Force a copy of this->object, otherwise
        // it will point to same object.
        $cells = array();
        foreach ($this->cells as $x=>$row)
        {
            foreach ($row as $y=>$cell)
            {
                $cells[$x][$y] = clone $cell;
            }
        }

        $this->cells = $cells;
    }

    /**
     * @return array
     */
    public function getCells(): array
    {
        return $this->cells;
    }

    private function fillBoardWithCells()
    {
        for ($x=1;$x<=$this->width;$x++)
        {
            for ($y=1;$y<=$this->height;$y++)
            {
                $this->cells[$x][$y] = Cell::factory($x,$y);
            }
        }
    }

    public function setCellsAliveByPattern($patternName = "default")
    {
        $pattern = $this->getPatternByName($patternName);
        foreach ($pattern as $row)
        {
            /* @var $cell Cell*/
            $cell = $this->cells[$row['x']][$row['y']];
            $cell->setIsAlive(true);
        }
    }

    private function getPatternByName($patternName)
    {
        switch ($patternName)
        {
            default:
                $aliveCells = array(
                    array('x'=>4,'y'=>4),
                    array('x'=>5,'y'=>4),
                    array('x'=>6,'y'=>4)
                );
        }

        return $aliveCells;
    }

    public function calculateNextGeneration()
    {
        $nextBoard = clone($this);
        foreach ($nextBoard->cells as $row)
        {
            /* @var $cell Cell*/
            foreach ($row as $cell)
            {
                $aliveNeighborNum = $this->getAliveNeighborsNum($cell);
                if ($aliveNeighborNum < 2 || $aliveNeighborNum > 3) $cell->willDie = true;
                if ($aliveNeighborNum == 3) $cell->willAlive = true;
            }
        }

        return $this->updateBoardByCellWillData($nextBoard);
    }

    private function getAliveNeighborsNum(Cell $cell)
    {
        $aliveNeighborNum = 0;

        for ($x = -1; $x <= 1; $x++)
        {
            for ($y = -1; $y <= 1; $y++)
            {
                if (isset($this->cells[$cell->x + $x][$cell->y + $y]) && !($x == 0 && $y == 0)) {
                    $neighborCell = $this->cells[$cell->x + $x][$cell->y + $y];
                    if ($neighborCell->isAlive) {
                        $aliveNeighborNum++;
                    }
                }
            }
        }

        return $aliveNeighborNum;
    }

    private function updateBoardByCellWillData(Board $board)
    {
        foreach ($board->cells as $row)
        {
            /* @var $cell Cell*/
            foreach ($row as $cell)
            {
                if ($cell->willDie) $cell->isAlive = false;
                if ($cell->willAlive) $cell->isAlive = true;
            }
        }

        return $board;
    }
}