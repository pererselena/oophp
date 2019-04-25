<?php
/**
 * Dice game.
 */

namespace Elpr\Dice;

/**
 * Showing off a standard class with methods and properties.
 */
class Player
{
    /**
     * @var string  $name   The name of the person.
     * @var integer $currentScore    Current score of the raund.
     * @var integer $totalScore    Total score of the game.
     */
    public $name;
    public $currentScore;
    public $totalScore;



    /**
     * Constructor to initiate the object with the players name,
     *
     * @param int $name The players name.
     */

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->currentScore = 0;
        $this->totalScore = 0;
    }

    /**
     * Returns true if the player won the game.
     *
     * @return bool Return true if score is 100.
     */

    public function hasWon()
    {
        return 100 < $this->currentScore + $this->totalScore;
    }

}
