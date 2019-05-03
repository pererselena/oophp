<?php

namespace Elpr\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test for the Histogram class.
 */
class HistogramTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $game = new Game();
        $game->player->throwDice();
        $game->computer->throwDice();
        $histogramPlayer = new Histogram();
        $histogramPlayer->injectData($game->player->dice);
        $histogramComputer = new Histogram();
        $histogramComputer->injectData($game->computer->dice);

        $this->assertInstanceOf("\Elpr\Dice\Histogram", $histogramPlayer);
    }

    /**
     * Testing getAsText method.
     */
    public function testGetAsText()
    {
        $game = new Game();
        $game->player->throwDice();
        $game->computer->throwDice();
        $histogramPlayer = new Histogram();
        $histogramPlayer->injectData($game->player->dice);
        $histogramComputer = new Histogram();
        $histogramComputer->injectData($game->computer->dice);

        $this->assertStringStartsWith("1", $histogramPlayer->getAsText());
        $this->assertGreaterThan(5, strlen($histogramComputer->getAsText()));
    }

    /**
     * Testing getSerie method.
     */
    public function testGetSerie()
    {
        $game = new Game();
        $game->player->throwDice();
        $game->computer->throwDice();
        $histogramPlayer = new Histogram();
        $histogramPlayer->injectData($game->player->dice);
        $histogramComputer = new Histogram();
        $histogramComputer->injectData($game->computer->dice);

        $this->assertCount(5, $histogramPlayer->getSerie());
        $this->assertCount(5, $histogramComputer->getSerie());
    }
}
