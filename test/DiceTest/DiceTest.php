<?php

namespace Elpr\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test for the dice class.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Elpr\Dice\Dice", $dice);

        $res = $dice->sides;
        $exp = 6;
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and verify that the object has the expected
     * properties. Use only first argument.
     */
    public function testCreateObjectFirstArgument()
    {
        $dice = new Dice(5);
        $this->assertInstanceOf("\Elpr\Dice\Dice", $dice);

        $res = $dice->sides;
        $exp = 5;
        $this->assertEquals($exp, $res);
    }

    /**
     * Testing getLastRoll method.
     */
    public function testGetLastRoll()
    {
        $dice = new Dice(1);
        $this->assertInstanceOf("\Elpr\Dice\Dice", $dice);

        $dice->roll();
        $res = $dice->getLastRoll();
        $exp = 1;
        $this->assertEquals($exp, $res);

        $dice2 = new Dice(2);
        $dice2->roll();
        $res = $dice2->getLastRoll();
        $min = 0;
        $max = 3;
        $this->assertThat(
            $res,
            $this->logicalAnd(
                $this->greaterThan($min),
                $this->lessThan($max)
            )
        );
    }

    /**
     * Testing roll method.
     */
    public function testRoll()
    {
        $dice = new Dice(1);
        $this->assertInstanceOf("\Elpr\Dice\Dice", $dice);

        $res = $dice->roll();
        $exp = 1;
        $this->assertEquals($exp, $res);

        $dice2 = new Dice(2);
        $res = $dice2->sides;
        $min = 1;
        $max = 2;
        $this->assertThat(
            $res,
            $this->logicalAnd(
                $this->greaterThanOrEqual($min),
                $this->lessThanOrEqual($max)
            )
        );
    }

    /**
     * Testing roll method fail.
     */
    public function testFailRoll()
    {
        $dice = new Dice(1);
        $this->assertInstanceOf("\Elpr\Dice\Dice", $dice);

        $res = $dice->roll();
        $exp = 2;
        $this->assertNotEquals($exp, $res);
    }
}
