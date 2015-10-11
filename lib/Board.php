<?php
/**
 * Created by PhpStorm.
 * User: asafb
 * Date: 10/11/15
 * Time: 10:13 AM
 */

class Board {
    private
        $borderSize = 3,
        $boardMatrix = [],
        $numberOfSlots = 0,
        $usedSlots = [];

    public function init(){
        $this->createMatrix();
    }

    public function addUsedSlots(Move $move){
        $this->usedSlots[] = $move->toArray();
    }

    public function getAvailableSlots(){
        $output = [];
        foreach ($this->boardMatrix as $index => $slot){
            if (!in_array($slot, $this->usedSlots))
                $output[] = $slot;
        }

        return $output;


        return @array_diff($this->boardMatrix, $this->usedSlots);
    }

    private function createMatrix(){
        foreach (range(1, $this->borderSize) as $colIndex){
            foreach(range(1, $this->borderSize) as $rowIndex){
                $this->boardMatrix[] = [$colIndex, $rowIndex];
                $this->numberOfSlots++;
            }
        }
    }

    /**
     * @return int
     */
    public function getNumberOfSlots()
    {
        return $this->numberOfSlots;
    }

    /**
     * @return int
     */
    public function getBoardSize()
    {
        return $this->borderSize;
    }

    /**
     * @return array
     */
    public function getBoardMatrix()
    {
        return $this->boardMatrix;
    }
}