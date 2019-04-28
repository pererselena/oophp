<?php

namespace Elpr\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test for the dice class.
 */
class DiceHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $dice = new DiceHand();
        $this->assertInstanceOf("\Elpr\Dice\DiceHand", $dice);

        $res = $dice->values();
        $exp = 5;
        $this->assertEquals($exp, count($res));
    }



    /**
     * Construct object and verify that the object has the expected
     * properties. Use only first argument.
     */
    public function testCreateObjectFirstArgument()
    {
        $dice = new DiceHand(2);
        $this->assertInstanceOf("\Elpr\Dice\DiceHand", $dice);

        $res = $dice->values();
        $exp = 2;
        $this->assertEquals($exp, count($res));
    }

    /**
     * Testing values method.
     */
    public function testValues()
    {
        $dice = new DiceHand(1);
        $this->assertInstanceOf("\Elpr\Dice\DiceHand", $dice);

        $dice->roll();
        $res = $dice->values();
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

    /**
     * Testing getClassNames method.
     */
    public function testGetClassNames()
    {
        $dice = new DiceHand(1);
        $this->assertInstanceOf("\Elpr\Dice\DiceHand", $dice);

        $dice->roll();
        $res = $dice->getClassNames();
        $this->assertStringStartsWith("dice-", $res[0]);
    }

    /**
     * Testing sum method.
     */
    public function testSum()
    {
        $dice = new DiceHand(1);
        $this->assertInstanceOf("\Elpr\Dice\DiceHand", $dice);

        $dice->roll();
        $res = $dice->sum();
        $min = 2;
        $max = 6;
        $this->assertThat(
            $res,
            $this->logicalOr(
                $this->equalTo(-1),
                $this->logicalAnd(
                    $this->greaterThanOrEqual($min),
                    $this->lessThanOrEqual($max)
                )
            )
        );

        $dice2 = new DiceHand(1);
        $this->assertInstanceOf("\Elpr\Dice\DiceHand", $dice);

        $dice2->addValues(2, 0);
        $this->assertEquals(2, $dice2->sum());

        $dice3 = new DiceHand(1);
        $this->assertInstanceOf("\Elpr\Dice\DiceHand", $dice);

        $dice3->addValues(1, 0);
        $this->assertEquals(-1, $dice3->sum());
    }
}
