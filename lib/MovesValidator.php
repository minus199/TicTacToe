<?php
/**
 * Created by PhpStorm.
 * User: asafb
 * Date: 10/11/15
 * Time: 4:48 PM
 */

class MovesValidator {
    private static $instance;
    private $board;

    private $p1, $p2;

    private function __construct(Game $game)
    {
        $this->board = $game->getBoard();
        $this->p1 = $game->getPlayerOne();
        $this->p2 = $game->getPlayerTwo();
    }

    public static function factory(Game $game){
        return self::$instance = new static($game);
    }

    /**
     * @return static
     */
    public static function getInstance(){
        return self::$instance;
    }

    public function validate(Move $move)
    {
        return
            in_array($move->toArray(), $this->board->getBoardMatrix())
            && !in_array($move, $this->p1->getMoves())
            && !in_array($move, $this->p2->getMoves());
    }
}