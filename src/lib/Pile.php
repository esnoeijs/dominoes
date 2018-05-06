<?php
declare(strict_types=1);

namespace Acme\lib;

class Pile implements \Countable
{
    /**
     * @var Tile[]
     */
    private $tiles = [];

    /**
     * Pile constructor.
     * @param Tile[] $tiles
     */
    public function __construct(array $tiles)
    {
        $this->tiles = $tiles;
    }

    /**
     * Removes a Tile from the pile
     */
    public function getPiece() : ?Tile
    {
        return array_shift($this->tiles);
    }

    /**
     * Returns the number of tiles in the pile.
     */
    public function count() : int
    {
       return count($this->tiles);
    }
}