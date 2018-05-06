<?php
declare(strict_types=1);

use Acme\lib\Pile;
use Acme\lib\Player;
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

$board->addFirstPiece($gamePile->getTile());

echo sprintf("Game starting with first tile: {$board->getBegin()->getLabel()}\n");

/** @var Player[] $players */
$players = [
    new Player('Alice'),
    new Player('Bob')
];

foreach ($players as $player) {
    $player->drawTile($gamePile, 7);
}

foreach ($players as $player) {
    while (true) {
        if ($player->hasMove($board)) {
            $player->makeMove($board);
        } else {
            $player->drawTile($gamePile);
        }
    }
}