<?php

/**
 * Created by PhpStorm.
 * User: asafb
 * Date: 10/11/15
 * Time: 10:06 AM
 */
abstract class PlayerBase
{
    private static $instance;

    private $name;
    private $moves = [];
    private $currentMove;
    private $rows = [];
    private $cols = [];

    private function __construct($name = "")
    {
        $this->name = $name;
    }

    /**
     * @param string $name
     * @return static
     */
    public static function getInstance($name = "")
    {
        return self::$instance instanceof PlayerBase ? self::$instance : new static($name);
    }

    /**
     * Computes/Asks for user next move and save currentMove
     * @param $board Board
     * @return $this
     */
    public function decideNextMove(Board $board)
    {
        $this->setCurrentMove($this->_decideNextMove($board));
        return $this;
    }

    abstract protected function _decideNextMove(Board $board);

    final public function doMove()
    {
        if (!$this->currentMove)
            throw new \Exception("Must decide move first. Call decideNextMove()");

        $this->moves[] = $this->currentMove;
        $this->rows[$this->getLastMove()->getMoveToRow()][] = $this->getLastMove()->getMoveToCol();
        $this->cols[$this->getLastMove()->getMoveToCol()][] = $this->getLastMove()->getMoveToRow();

        echo $this->getName() . " moved to " . $this->currentMove . PHP_EOL;

        unset($this->currnetMove);

        return $this;
    }

    public function onWin()
    {
        echo PHP_EOL . "Thank you. Good game." . PHP_EOL;
    }

    public function onLose()
    {
        echo PHP_EOL . "Thank you. Good game." . PHP_EOL;
    }

    final public function winningStatus($numberOfSlotsForWinning)
    {
        if (count($this->rows) == $numberOfSlotsForWinning)
            return true;

        if (count($this->cols) == $numberOfSlotsForWinning)
            return true;

        $w = 1;
        for ($y = 1, $x = $numberOfSlotsForWinning; $y == $numberOfSlotsForWinning, $x == 1; $y++, $x--) {
            $w += (int)in_array([$y, $x], $this->getMoves());

            if ($w == $numberOfSlotsForWinning)
                return true;
        }

        $w = 1;
        for ($i = 1; $i == 3; $i++) {
            $w += (int)in_array([$i, $i], $this->getMoves());

            if ($w == $numberOfSlotsForWinning)
                return true;
        }

        return false;
    }

    final protected function valMove(Move $nextMove){
        return MovesValidator::getInstance()->validate($nextMove);
    }

    /**
     * @return Move
     */
    final public function getLastMove()
    {
        return count($this->moves) ? $this->moves[count($this->moves) - 1] : null;
    }

    /**
     * @param Move $currentMove
     * @return $this;
     */
    protected function setCurrentMove(Move $currentMove)
    {
        $this->currentMove = $currentMove;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrentMove()
    {
        return $this->currentMove;
    }

    /**
     * @return mixed
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @return mixed
     */
    public function getCols()
    {
        return $this->cols;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Move[]
     */
    public function getMoves()
    {
        return $this->moves;
    }
}