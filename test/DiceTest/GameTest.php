<?php

namespace Elpr\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test for the game class.
 */
class GameTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $game = new Game();
        $this->assertInstanceOf("\Elpr\Dice\Game", $game);

        $res = $game->player->name;
        $exp = "Player 1";
        $this->assertEquals($exp, $res);

        $res = $game->computer->name;
        $exp = "Computer";
        $this->assertEquals($exp, $res);

        $res = $game->winner;
        $exp = "";
        $this->assertEquals($exp, $res);
    }

    /**
     * Testing playRound method.
     */
    public function testPlayRound()
    {
        $game = new Game();
        $this->assertInstanceOf("\Elpr\Dice\Game", $game);

        $res = $game->playRound("");
        $exp = true;
        $this->assertEquals($exp, $res);

        $res2 = $game->playRound("roll");
        $exp = true;
        $this->assertEquals($exp, $res2);

        $game->player->totalScore = 100;
        $res3 = $game->playRound("roll");
        $exp = false;
        $this->assertEquals($exp, $res3);

        $game->player->totalScore = 10;
        $game->computer->totalScore = 100;
        $res4 = $game->playRound("roll");
        $exp = false;
        $this->assertEquals($exp, $res4);
    }

    /**
     * Testing computerRoll method.
     */
    public function testComputerRoll()
    {
        $game = new Game();
        $this->assertInstanceOf("\Elpr\Dice\Game", $game);

        $game->computerRoll();
        $res = $game->computer->canPlayAgain;
        $exp = true;
        $this->assertEquals($exp, $res);
        $game->player->totalScore = 90;
        $game->player->currentScore = 1;

        $game->computerRoll();
        $res2 = $game->computer->currentScore;
        $exp = 0;
        $this->assertEquals($exp, $res2);

        $game->computerRoll();
        $res2 = $game->computer->currentScore;
        $exp = 0;
        $this->assertEquals($exp, $res2);
    }
}
