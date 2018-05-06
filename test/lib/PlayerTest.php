<?php

namespace Acme\lib;

use \PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function test()
    {
        $player = new Player('Foo');
        $tiles = new Pile([
            new Tile(0,0),
            new Tile(1,1)
        ]);

        $board = new TileSequence();
        $board->addFirstPiece(new Tile(1,2));

        $player->drawTile($tiles);

        $this->assertFalse($player->hasMove($board), 'player should only have a non-matching tile and not be able to match 1:2');

        $player->drawTile($tiles);

        $this->assertTrue($player->hasMove($board), 'player should now have a matching tile');


    }
}