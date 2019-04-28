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
     * @var string  $number   The name of the person.
     * @var integer $tries    The tries of the person.
     */
    public $numbers;
    public $tries;
    public $sides;
    private $lastRoll;


    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */

    public function __construct(int $sides = 6, int $tries = 1)
    {
        $this->numbers = array();
        $this->tries = $tries;
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
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return int
     */

    public function roll()
    {
        $this->lastRoll = rand(1, $this->sides);
        return $this->lastRoll;
    }
}
