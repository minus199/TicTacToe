<?php

/**
 * Created by PhpStorm.
 * User: asafb
 * Date: 10/11/15
 * Time: 10:25 AM
 */
class Game
{
    private $board;
    private $lastMove;

    private
        $playerOne,
        $playerTwo,
        $currentTurnOwner;

    const
        TURN_OWNER_P1 = 0,
        TURN_OWNER_P2 = 1;

    public function __construct(Board $board, PlayerBase $playerOne, PlayerBase $playerTwo)
    {
        $this->playerOne = $playerOne;
        $this->playerTwo = $playerTwo;
        $this->board = $board;

        $this->currentTurnOwner = self::TURN_OWNER_P1; // P1 starts game always by default

        MovesValidator::factory($this);
    }

    public static function factory(Board $board, PlayerBase $playerOne, PlayerBase $playerTwo)
    {
        return new static($board, $playerOne, $playerTwo);
    }

    public function StartGame()
    {
        $this->getBoard()->init();

        $totalMovesMade = 0;
        while ($totalMovesMade != $this->getBoard()->getNumberOfSlots()) {
            $this
                ->getCurrentTurnOwner()
                    ->decideNextMove($this->getBoard())->doMove();

            $this->getBoard()->addUsedSlots($this->getCurrentTurnOwner()->getLastMove());

            if ($player = $this->checkWinnings())
                return $player;

            $totalMovesMade = count($this->getPlayerOne()->getMoves()) + count($this->getPlayerTwo()->getMoves());

            $this->moveTurn();
        }

        return "TIE";  // All slots are full, game over with tie i guess.
    }


    private function checkWinnings(){
        if ($this->getPlayerOne()->winningStatus($this->getBoard()->getNumberOfSlots()))
            return $this->getPlayerOne();

        if ($this->getPlayerTwo()->winningStatus($this->getBoard()->getNumberOfSlots()))
            return $this->getPlayerTwo();

        return null;
    }

    /**
     * @return PlayerBase
     * @throws Exception
     */
    public function getCurrentTurnOwner()
    {
        switch ($this->currentTurnOwner) {
            case self::TURN_OWNER_P1:
                return $this->getPlayerOne();
            case self::TURN_OWNER_P2:
                return $this->getPlayerTwo();
            default:
                throw new \Exception("Player not found");
        }
    }

    private function moveTurn(){
        $this->currentTurnOwner = $this->currentTurnOwner == self::TURN_OWNER_P1 ? self::TURN_OWNER_P2 : self::TURN_OWNER_P1;
    }

    /**
     * @return Board
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * @return mixed
     */
    public function getLastMove()
    {
        return $this->lastMove;
    }

    /**
     * @return PlayerBase
     */
    public function getPlayerOne()
    {
        return $this->playerOne;
    }

    /**
     * @return PlayerBase
     */
    public function getPlayerTwo()
    {
        return $this->playerTwo;
    }
}