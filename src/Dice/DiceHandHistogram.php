<?php

namespace Elpr\Dice;

/**
* A dice which has the ability to present data to be used for creating
* a histogram.
*/
class DiceHandHistogram extends DiceHand implements HistogramInterface
{
     use HistogramTrait2;
     /**
      * Get max value for the histogram.
      *
      * @return int with the max value.
      */
    public function getHistogramMax()
    {
        return 6;
    }
    /**
    * Roll the dice, remember its value in the serie
    *
    * @return void
    */
    public function roll()
    {
        parent::roll();
        $lastRoll = $this->values();
        $this->serieRoll = array_merge($this->serieRoll, $lastRoll);
    }
}
