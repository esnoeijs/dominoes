<?php
declare(strict_types=1);

namespace Acme\lib;

class Tile
{
    public const BEGIN = 0;
    public const END = 1;

    /**
     * @var int[]
     */
    private $spots;
    /**
     * @var Tile[]
     */
    private $attachedTile = [];
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
     * @param bool $noReverse if set to true the numbers will be printed in original sequence
     * @return string
     */
    public function getLabel($noReverse = false): string
    {
        $reverse = $noReverse ? false : $this->reverse;
        return sprintf('<%s>', implode(':', $reverse ? array_reverse($this->spots) : $this->spots));
    }

    /**
     * @param int $side
     * @param Tile $tile
     * @return void
     */
    public function attach(int $side, Tile $tile): void
    {
        if ($this->isReversed()) {
            $side = $side ? self::BEGIN : self::END;
        }
        $this->attachedTile[$side] = $tile;
    }

    /**
     * @param int $numberA
     * @return bool
     */
    public function hasNumber(int $numberA): bool
    {
        return \in_array($numberA, $this->spots, true);
    }

    /**
     * @param int $side
     * @param Tile $tile
     * @return bool
     */
    public function canAttach(int $side, Tile $tile): bool
    {
        if ($this->isReversed()) {
            $side = $side ? self::BEGIN : self::END;
        }

        return
            $tile->hasNumber($this->spots[$side])
            && false === isset($this->attachedTile[$side])
            && $tile !== $this;
    }

    /**
     * @param int $side
     * @return Tile|null
     */
    public function getAttached(int $side): ?Tile
    {
        return $this->attachedTile[$side];
    }

    /**
     * Sets the tile to be displayed in reverse
     */
    public function setReverse(): void
    {
        $this->reverse = true;
    }

    /**
     * @return bool
     */
    public function isReversed(): bool
    {
        return $this->reverse;
    }

    /**
     * @param int $side
     * @return int
     */
    public function getSpots(int $side): int
    {
        return $this->spots[$side];
    }
}