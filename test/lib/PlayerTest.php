<?php

namespace Acme\lib;

use \PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testHasMove()
    {
        $player = new Player('Foo');
        $this->assertEquals('Foo', $player->getName());
        $tiles = new Pile([
            new Tile(0,0),
            new Tile(1,1),
        ]);

        $board = new TileSequence();
        $board->addFirstPiece(new Tile(1,2));

        $player->drawTile($tiles);

        $this->assertFalse($player->makeMove($board), 'player should only have a non-matching tile and not be able to match 1:2');

        $this->assertEquals(1 ,$player->countTiles());
        $player->drawTile($tiles);
        $this->assertEquals(2 ,$player->countTiles());

        $this->assertTrue($player->makeMove($board), 'player should now have a matching tile');
        $this->assertEquals(1 ,$player->countTiles());

        $this->assertFalse($player->drawTile($tiles));
    }


}