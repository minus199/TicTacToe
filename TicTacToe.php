<?php
/**
 * Created by PhpStorm.
 * User: asafb
 * Date: 10/11/15
 * Time: 1:52 PM
 */

include "lib" . DIRECTORY_SEPARATOR . "MovesValidator.php";
include "lib" . DIRECTORY_SEPARATOR . "PlayerBase.php";
include "lib" . DIRECTORY_SEPARATOR . "ComputerPlayer.php";
include "lib" . DIRECTORY_SEPARATOR . "HumanPlayer.php";
include "lib" . DIRECTORY_SEPARATOR . "Board.php";
include "lib" . DIRECTORY_SEPARATOR . "Game.php";
include "lib" . DIRECTORY_SEPARATOR . "Move.php";


$game = Game::factory(new Board(), ComputerPlayer::getInstance("(X) CPU"), HumanPlayer::getInstance("(O) Human"));
if ($winner = $game->StartGame())
    echo "\n\n" . $winner->getName() . "Won. " . $winner->onWin();
else
    echo "\nTIE!!\n";
