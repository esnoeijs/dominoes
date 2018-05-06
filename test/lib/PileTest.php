<?php

namespace Acme\lib;

use \PHPUnit\Framework\TestCase;

class PileTest extends TestCase
{
    public function testGetPiece()
    {
        $tiles = [
            '0:0' => new Tile(0, 1),
            '0:1' => new Tile(0, 2),
            '0:2' => new Tile(0, 3),
            '0:3' => new Tile(0, 4),
            '0:4' => new Tile(0, 5)
        ];

        $pile = new Pile($tiles);

        for ($i = 0; $i < count($tiles); $i++) {
            $this->assertNotNull($pile->getPiece(), 'Should return a tile piece');
        }
        $this->assertNull($pile->getPiece(), 'There should be no more pieces');
    }

}