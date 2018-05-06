<?php
declare(strict_types=1);

namespace Acme\lib;

use \PHPUnit\Framework\TestCase;

class TileSetFactoryTest extends TestCase
{
    private static $tiles = [
        '0:0',
        '0:1', '1:1',
        '0:2', '1:2', '2:2',
        '0:3', '1:3', '2:3', '3:3',
        '0:4', '1:4', '2:4', '3:4', '4:4',
        '0:5', '1:5', '2:5', '3:5', '4:5', '5:5',
        '0:6', '1:6', '2:6', '3:6', '4:6', '5:6', '6:6',
    ];

    public function testGetTileSetCorrectNumberOfTiles()
    {
        $tileSetFac = new TileSetFactory();
        $this->assertCount(count(self::$tiles), $tileSetFac->getTileSet());
    }

    public function testGetTileSetCorrectSet()
    {
        $tileSetFac = new TileSetFactory();
        $tileSet = $tileSetFac->getTileSet();

        foreach ($tileSet as $tile) {
            list($numberA, $numberB) = explode(':', $tile->getLabel());
            $this->assertTrue(
                $numberA <= $numberB,
                "Number A on a tile should always be smaller then numberB ({$tile->GetLabel()})"
            );
        }

        foreach (self::$tiles as $tileLabel) {
            $this->assertArrayHasKey($tileLabel, $tileSet, "Missing tile in set {$tileLabel}");
            if (isset($tileSet[$tileLabel])) {
                unset($tileSet[$tileLabel]);
            }
        }

        $this->assertCount(
            0,
            $tileSet,
            sprintf('Too many unknown tile combinations (%s)',
                join(', ', array_map(function (Tile $tile) {
                    return $tile->getLabel();
                }, $tileSet)))
        );
    }
}