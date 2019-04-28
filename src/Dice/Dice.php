<?php
/**
 * Dice game.
 */

namespace Elpr\Dice;

/**
 * Showing off a standard class with methods and properties.
 */
class Dice
{
    /**
     * @var int  $sides   Number of sides of the dice.
     * @var int $lastRoll  Holds the result of the last roll.
     */

    public $sides;
    private $lastRoll;


    /**
     * Constructor to initiate the object with current game settings,
     * if available.
     *
     * @param int $sides The number of sides of the dice, default 6.
     *
     */

    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    /**
     * Returns the lastRoll.
     *
     * @return int
     */

    public function getLastRoll()
    {
        return $this->lastRoll;
    }

    /**
     * Perform the roll of the dice.
     *
     * @return int
     */

    public function roll()
    {
        $this->lastRoll = rand(1, $this->sides);
        return $this->lastRoll;
    }
}
