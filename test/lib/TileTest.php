<?php

namespace Acme\lib;

use \PHPUnit\Framework\TestCase;


class TileTest extends TestCase
{
    public function testTile()
    {
        $tile = new Tile(1,0);
        $this->assertEquals('<0:1>', $tile->getLabel());
        $tile->setReverse();
        $this->assertEquals('<1:0>', $tile->getLabel());
    }

    public function testHasNumber()
    {
        $tile = new Tile(1,2);
        $this->assertTrue($tile->hasNumber(1));
        $this->assertFalse($tile->hasNumber(3));
    }

    public function testCanAttach()
    {
        $tileA = new Tile(0,1);
        $tileB = new Tile(1,2);
        $tileC = new Tile(2,2);

        $this->assertTrue($tileA->canAttach(Tile::END, $tileB));
        $this->assertFalse($tileA->canAttach(Tile::BEGIN, $tileB));
        $this->assertFalse($tileA->canAttach(Tile::END, $tileC));
    }

    public function testAttach()
    {
        $tileA = new Tile(0,1);
        $tileB = new Tile(1,2);

        $this->assertTrue($tileA->attach(Tile::END, $tileB));
        $this->assertFalse($tileA->attach(Tile::BEGIN, $tileB));
        $this->assertSame($tileA, $tileB->getAttached(Tile::BEGIN));
    }
}