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

$shuffleTiles = $tiles = $tileSetFactory->getTileSet();
shuffle($shuffleTiles);
array_multisort($shuffleTiles, $tiles);

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

while (true) {
    $player = array_shift($players);
    while (false === $player->makeMove($board)) {
        echo "{$player->getName()} draw\n";
        if (false === $player->drawTile($gamePile))  {
            echo $player->getName() . " lost\n";
            exit();
        }
    }

    array_push($players, $player);
}