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
     * @var Dice $dice Dice object.
     * @var integer $dice Sum from current roll.
     * @var bool $canPlayAgain True if the player can roll again.
     */
    public $name;
    public $currentScore;
    public $totalScore;
    private $dice;
    public $sum;
    public $canPlayAgain;



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
        $this->dice = new \Elpr\Dice\DiceHand();
        $this->canPlayAgain = true;
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

    /**
     * Throw all dices by calling roll in dice object.
     *
     * @return bool Returns true if the player can continue to play.
     */

    public function throwDice()
    {
        $this->dice->roll();
        $this->sum = $this->dice->sum();
        if ($this->sum === -1) {
            $this->currentScore = 0;
            $this->canPlayAgain = false;
            return false;
        }
        $this->currentScore += $this->sum;
        $this->canPlayAgain = true;
        return true;
    }

    /**
     * Save the players currentScore to total score.
     *
     * @return void
     */

    public function saveScore()
    {
        $this->totalScore += $this->currentScore;
        $this->currentScore = 0;
        $this->canPlayAgain = true;
    }


    /**
     * Returns the css class names from the dice object..
     *
     * @return array with classnames for each dice.
     */
    public function getClassNames()
    {
        return $this->dice->getClassNames();
    }

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        return $this->dice->values();
    }






}
