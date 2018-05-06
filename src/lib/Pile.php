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
    public function __construct(array $tiles = [])
    {
        $this->tiles = $tiles;
    }

    /**
     * Removes a Tile from the pile
     */
    public function getTile() : ?Tile
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

    /**
     * @param Tile $tile
     */
    public function addTile(Tile $tile) : void
    {
        $this->tiles[$tile->getLabel()] = $tile;
    }

    /**
     * @return Tile[]
     */
    public function getTiles() : array
    {
        return $this->tiles;
    }

    /**
     * @param Tile $tile
     */
    public function removeTile(Tile $tile) : void
    {
         unset($this->tiles[$tile->getLabel(true)]);
    }
}