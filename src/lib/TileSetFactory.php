<?php
declare(strict_types=1);

namespace Acme\lib;

class TileSetFactory
{
    /**
     * Generate the full set of tile combinations.
     *
     * @return Tile[]
     */
    public function getTileSet() : array
    {
        $tileSet = [];
        for ($numberA = 0; $numberA <= 6; $numberA++) {
            for ($numberB = 0; $numberB <= 6; $numberB++) {
                $tile = new Tile($numberA, $numberB);

                if (isset($tileSet[$tile->getLabel()])) {
                    continue;
                }
                $tileSet[$tile->getLabel()] = $tile;
            }
        }

        return $tileSet;
    }
}