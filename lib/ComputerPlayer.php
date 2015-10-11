<?php
/**
 * Created by PhpStorm.
 * User: asafb
 * Date: 10/11/15
 * Time: 10:35 AM
 */

final class ComputerPlayer extends PlayerBase {
    protected function _decideNextMove(Board $board)
    {
        if ($this->getCols())
            foreach ($this->getCols() as $col => $rows){
                if (count($rows) == ($board->getBoardSize()-1)){
                    $nextMove = new Move($col, array_diff(range(1, $board->getBoardSize()), $rows));

                    if (($this->valMove($nextMove)))
                        return $nextMove;
                }
            }

        if ($this->getRows())
            foreach ($this->getRows() as $row => $cols){
                if (count($cols) == ($board->getBoardSize()-1)){
                    $nextMove = new Move($row, array_diff(range(1, $board->getBoardSize()), $cols));
                    if (($this->valMove($nextMove)))
                        return $nextMove;
                }
            }

        $slot = (int)round($board->getBoardSize()/2);
        $nextMove = new Move($slot, $slot);
        if (($this->valMove($nextMove)))
            return $nextMove;

        $nextMoveD = $board->getAvailableSlots()[rand(0, count($board->getAvailableSlots())-1)];

        return new Move($nextMoveD[0], $nextMoveD[1]);
    }
}