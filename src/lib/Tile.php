<?php
declare(strict_types=1);

namespace Acme\lib;

class Tile
{
    /**
     * @var int
     */
    private $numberA;
    /**
     * @var int
     */
    private $numberB;

    /**
     * Tile constructor.
     *
     * @param int $numberA
     * @param int $numberB
     */
    public function __construct(int $numberA, int $numberB)
    {
        // We make sure the first number is always the smaller one.
        // This simplifies working with the tiles when comparing the numbers
        if ($numberA > $numberB) {
            $this->numberA = $numberB;
            $this->numberB = $numberA;
        } else {
            $this->numberA = $numberA;
            $this->numberB = $numberB;
        }
    }

    /**
     * @return string
     */
    public function getLabel() : string
    {
        return $this->numberA . ':' . $this->numberB;
    }
}