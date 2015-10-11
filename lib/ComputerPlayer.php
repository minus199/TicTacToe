<?php
/**
 * Created by PhpStorm.
 * User: asafb
 * Date: 10/11/15
 * Time: 10:35 AM
 */

final class ComputerPlayer extends PlayerBase {
    private function getPreferredMoves(){
        return [
            [[1,1], [2,2], [3,3]],
            [[1,1], [1,2], [1,3]],
            [[1,1], [2,1], [3,1]],
            [[3,1], [3,2], [3,3]]
        ];
    }

    protected function _decideNextMove(Board $board)
    {
        foreach ($this->getCols() as $col => $rows){
            $nextMove = new Move($col, array_diff(range(1, $board->getBoardSize()), $rows));
            if ($this->valMove($nextMove)){
                return $nextMove;
            }
        }

        $m = $this->getPreferredMoves();
        shuffle($m);
        foreach ($m as $prefMoves) {
            shuffle($prefMoves);
            foreach ($prefMoves as $prefMove) {
                $testMove = new Move($prefMove[0], $prefMove[1]);
                if (in_array($testMove->toArray(), $board->getAvailableSlots())) {
                    return $testMove;
                }
            }
        }

        $nextMove = new Move(rand(1,$board->getBoardSize()), rand(1,$board->getBoardSize()));
        while(!$this->valMove($nextMove)){
            $nextMove = $this->_decideNextMove($board);
        }

        return $nextMove;
    }
}