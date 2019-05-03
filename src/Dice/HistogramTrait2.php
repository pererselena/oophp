<?php

namespace Elpr\Dice;

/**
 * A trait implementing HistogramInterface.
 */
trait HistogramTrait2
{
    /**
     * @var array $serieRoll  The numbers stored in sequence.
     */
    private $serieRoll = [];



    /**
     * Get the serieRoll.
     *
     * @return array with the serieRoll.
     */
    public function getHistogramSerie()
    {
        return $this->serieRoll;
    }



    /**
     * Get min value for the histogram.
     *
     * @return int with the min value.
     */
    public function getHistogramMin()
    {
        return 1;
    }



    // /**
    //  * Get max value for the histogram.
    //  *
    //  * @return int with the max value.
    //  */
    // public function getHistogramMax()
    // {
    //     return max($this->serieRoll);
    // }
}
