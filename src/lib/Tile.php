<?php
declare(strict_types=1);

namespace Acme\lib;

class Tile
{
    const BEGIN = 0;
    const END = 1;

    /**
     * @var int[]
     */
    private $spots;
    /**
     * @var Tile[]
     */
    private $attachedTile;
    /**
     * @var bool
     */
    private $reverse = false;

    /**
     * Tile constructor.
     *
     * @param int $numberA
     * @param int $numberB
     */
    public function __construct(int $numberA, int $numberB)
    {
        $this->spots = [$numberA, $numberB];

        // We make sure the first number is always the smaller one.
        // This simplifies working with the tiles when comparing the numbers
        sort($this->spots);
    }

    /**
     * @return string
     */
    public function getLabel() : string
    {
        return sprintf('<%s>', implode(':', $this->reverse ? array_reverse($this->spots) : $this->spots));
    }

    /**
     * @param int $side
     * @param Tile $tile
     * @return bool
     */
    public function attach(int $side, Tile $tile) : bool
    {
        if ($this->canAttach($side, $tile)) {
            if ($tile->getSpots($side) !== $this->getSpots($side)) {
                $tile->setReverse();
            }

            echo "attached " . $this->getLabel() . " to " . $tile->getLabel(). "\n";

            $this->attachedTile[$side] = $tile;
            $tile->attach($side === self::END ? self::BEGIN : self::END, $this);

            return true;
        }

        return false;
    }

    /**
     * @param int $numberA
     * @return bool
     */
    public function hasNumber(int $numberA) : bool
    {
        return in_array($numberA, $this->spots, true);
    }

    /**
     * @param int $side
     * @param Tile $tile
     * @return bool
     */
    public function canAttach(int $side, Tile $tile) : bool
    {
        return $tile->hasNumber($this->spots[$side]) && $this->attachedTile[$side] === null && $tile !== $this;
    }

    /**
     * @param int $side
     * @return Tile|null
     */
    public function getAttached(int $side) : ?Tile
    {
        return $this->attachedTile[$side];
    }

    /**
     * Sets the tile to be displayed in reverse
     */
    public function setReverse()
    {
        $this->reverse = true;
    }

    /**
     * @param int $side
     * @return int
     */
    public function getSpots(int $side) : int
    {
        return $this->spots[$side];
    }
}