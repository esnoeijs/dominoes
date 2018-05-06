<?php
declare(strict_types=1);

use Acme\lib\Pile;
use Acme\lib\Tile;
use Acme\lib\TileSequence;
use Acme\lib\TileSetFactory;

require(__DIR__ . '/../vendor/autoload.php');


new Tile(0,1);

$tileSetFactory = new TileSetFactory();

$tiles = $tileSetFactory->getTileSet();
shuffle($tiles);
$gamePile = new Pile($tiles);

$board = new TileSequence();

$board->addFirstPiece($gamePile->getPiece());