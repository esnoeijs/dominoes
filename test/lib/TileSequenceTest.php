<?php

namespace lib;

use Acme\lib\Tile;
use Acme\lib\TileSequence;
use \PHPUnit\Framework\TestCase;

class TileSequenceTest extends TestCase
{
    public function testSequence()
    {
        $tiles = [
            '0:0' => new Tile(0, 0),
            '0:1' => new Tile(0, 1),
            '0:2' => new Tile(0, 2),
            '0:3' => new Tile(0, 3),
            '0:4' => new Tile(0, 4),
            '1:4' => new Tile(1, 4),
            '2:4' => new Tile(2, 4),
        ];

        $seq = new TileSequence();
        $seq->addFirstPiece($tiles['0:0']);

        $this->assertSame($tiles['0:0'], $seq->getBegin());
        $this->assertSame($tiles['0:0'], $seq->getEnd());
        $this->assertEquals('<0:0>', $seq->getSequenceAsString());

        $seq->attachBegin($tiles['0:1']);
        $this->assertEquals('<1:0> <0:0>', $seq->getSequenceAsString());

        $seq->attachBegin($tiles['1:4']);
        $this->assertEquals('<4:1> <1:0> <0:0>', $seq->getSequenceAsString());

        $seq->attachBegin($tiles['2:4']);
        $this->assertEquals('<2:4> <4:1> <1:0> <0:0>', $seq->getSequenceAsString());

        $this->assertSame($tiles['2:4'], $seq->getBegin());
        $this->assertSame($tiles['0:0'], $seq->getEnd());

        $seq->attachEnd($tiles['0:2']);
        $this->assertEquals('<2:4> <4:1> <1:0> <0:0> <0:2>', $seq->getSequenceAsString());
        $this->assertSame($tiles['0:2'], $seq->getEnd());
    }

    public function testCanConnect()
    {
        $seq = new TileSequence();
        $seq->addFirstPiece(new Tile(0,3));
        $seq->attachEnd(new Tile(3,4));


        $this->assertTrue($seq->canConnect(new Tile(0,1)), '0:1 should be able to connect To the sequence BEGIN');
        $this->assertFalse($seq->canConnect(new Tile(1,2)), "1:2 should not be able to connect with 0:0");
        $this->assertTrue($seq->canConnect(new Tile(1,4)), '1:4 should be able to connect to the sequence END');


    }
}

