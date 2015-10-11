<?php
/**
 * Created by PhpStorm.
 * User: asafb
 * Date: 10/11/15
 * Time: 10:41 AM
 */

class Move {
    private $moveToCol;
    private $moveToRow;

    function __construct($moveToCol, $moveToRow)
    {
        $this->moveToCol = $moveToCol;
        $this->moveToRow = $moveToRow;
    }

    /**
     * @return mixed
     */
    public function getMoveToCol()
    {
        return $this->moveToCol;
    }

    /**
     * @return mixed
     */
    public function getMoveToRow()
    {
        return $this->moveToRow;
    }

    public function toArray(){
        return [$this->getMoveToCol(), $this->getMoveToRow()];
    }

    function __toString()
    {
        return "Col: " . $this->moveToCol . ". Row: " . $this->moveToRow . PHP_EOL;
    }
}