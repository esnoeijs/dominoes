<?php
declare(strict_types=1);

namespace Acme\lib;

class TileSequence
{
    /**
     * @var Tile[]
     */
    private $tiles = [];

    /**
     * @param Tile $tile
     */
    public function addFirstPiece(Tile $tile)
    {
        $this->tiles[] = $tile;
    }
}