<?php

namespace Elpr\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test for the player class.
 */
class PlayerTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectFirstArgument()
    {
        $player = new Player("Player 1");
        $this->assertInstanceOf("\Elpr\Dice\Player", $player);

        $res = $player->name;
        $exp = "Player 1";
        $this->assertEquals($exp, $res);
    }

    /**
     * Testing getClassNames method.
     */
    public function testGetClassNames()
    {
        $player = new Player("Player 1");
        $this->assertInstanceOf("\Elpr\Dice\Player", $player);

        $player->throwDice();
        $res = $player->getClassNames();
        $this->assertStringStartsWith("dice-", $res[0]);
    }

    /**
     * Testing values method.
     */
    public function testValues()
    {
        $player = new Player("Player 1");
        $this->assertInstanceOf("\Elpr\Dice\Player", $player);

        $player->throwDice();
        $res = $player->values();
        $min = 1;
        $max = 6;
        $this->assertThat(
            $res[0],
            $this->logicalAnd(
                $this->greaterThanOrEqual($min),
                $this->lessThanOrEqual($max)
            )
        );
    }
}
