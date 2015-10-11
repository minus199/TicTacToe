<?php
/**
 * Created by PhpStorm.
 * User: asafb
 * Date: 10/11/15
 * Time: 10:51 AM
 */

final class HumanPlayer extends PlayerBase{
    protected function _decideNextMove(Board $board)
    {
        $currentChosenMove = $this->promptUser();
        while(!$this->valMove($currentChosenMove)){
            echo "\nInvalid move. Try again.\n";
            $currentChosenMove = $this->promptUser($currentChosenMove);
        }

        return $currentChosenMove;
    }

    private function promptUser(){
        $col = (int)readline("Column number: ");
        $row = (int)readline("Row number: ");

        return new Move($col, $row);
    }
}