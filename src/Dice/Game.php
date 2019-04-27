<?php
/**
 * Dice game.
 */

namespace Elpr\Dice;

/**
 * Showing off a standard class with methods and properties.
 */
class Game
{
    /**
     * @var Player  $player   Representing the player in the game.
     * @var Player $computer    Representing the computer in the game.
     * @var string $winner    Representing the winner in the game.
     */
    public $player;
    public $computer;
    public $winner;


    /**
     * Constructor to initiate the game object with two player objects.
     *
     */

    public function __construct()
    {
        $this->player = new \Elpr\Dice\Player("Player 1");
        $this->computer = new \Elpr\Dice\Player("Computer");
        $this->winner = "";
    }

    /**
     * Playes the current round.
     *
     * @return void
     */

    public function playRound($save)
    {
        if ($this->computer->hasWon()) {
            $winner = $this->computer->name;
        } elseif ($this->player->hasWon()) {
            $winner = $this->player->name;
        }
    }
}
