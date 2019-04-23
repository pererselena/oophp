<?php namespace Elpr\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
     * @var Dice $dices   Array consisting of dices.
     * @var int  $values  Array consisting of last roll of the dices.
     * @var string $classNames Array with classnames for CSS for each dice.
     */
    private $dices;
    private $values;
    private $classNames;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct(int $dices = 5)
    {
        $this->dices  = [];
        $this->values = [];

        for ($i = 0; $i < $dices; $i++) {
            $this->dices[]  = new \Elpr\Dice\DiceGraphic();
            $this->values[] = null;
            $this->classNames[] = null;
        }
    }

    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function roll()
    {
        $counter = 0;
        foreach ($this->dices as $dice) {
            $this->values[$counter] = $dice->roll();
            $this->classNames[$counter] = $dice->graphic();
            $counter ++;
        }
    }

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        return $this->values;
    }

    /**
    * Get the classnames from the last roll.
    *@return array with classnames for each dice.
    */
    public function getClassNames()
    {
        return $this->classNames;
    }

    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum()
    {
        if (in_array(1, $this->values)) {
            return - 1;
        }
        return array_sum($this->values);
    }

    /**
     * Get the average of all dices.
     *
     * @return float as the average of all dices.
     */
    public function average()
    {
        return array_sum($this->values) / count($this->values);
    }
}
