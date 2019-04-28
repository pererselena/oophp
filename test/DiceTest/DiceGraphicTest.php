<?php

namespace Elpr\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test for the DiceGraphic class.
 */
class DiceGraphicTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $dice = new DiceGraphic();
        $this->assertInstanceOf("\Elpr\Dice\DiceGraphic", $dice);

        $res = $dice->sides;
        $exp = 6;
        $this->assertEquals($exp, $res);
    }

    /**
     * Testing getLastRoll method.
     */
    public function testGetLastRoll()
    {
        $dice = new DiceGraphic();
        $this->assertInstanceOf("\Elpr\Dice\DiceGraphic", $dice);

        $dice->roll();
        $res = $dice->getLastRoll();
        $min = 1;
        $max = 6;
        $this->assertThat(
            $res,
            $this->logicalAnd(
                $this->greaterThanOrEqual($min),
                $this->lessThanOrEqual($max)
            )
        );
    }

    /**
     * Testing graphic method.
     */
    public function testGraphic()
    {
        $dice = new DiceGraphic();
        $this->assertInstanceOf("\Elpr\Dice\DiceGraphic", $dice);

        $dice->roll();
        $res = $dice->graphic();
        $this->assertStringStartsWith("dice-", $res);
    }
}
