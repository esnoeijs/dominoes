<?php
declare(strict_types=1);

use Acme\lib\Pile;
use Acme\lib\Player;
use Acme\lib\Tile;
use Acme\lib\TileSequence;
use Acme\lib\TileSetFactory;

require __DIR__ . '/../vendor/autoload.php';

$tileSetFactory = new TileSetFactory();

$shuffleTiles = $tileSetFactory->getTileSet();
shuffle($shuffleTiles);
$tiles = [];
foreach ($shuffleTiles as $tile) {
    $tiles[$tile->getLabel()] = $tile;
}

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

$staleMateCounter = 0;
while (true) {
    $player = array_shift($players);
    while (false === $player->makeMove($board)) {
        if ($player->countTiles() === 0) {
            echo $player->getName() . " has won\n";
            exit();
        }

        if (false !== $player->drawTile($gamePile)) {
            echo "{$player->getName()} can't play, drawing tile {$player->getLastDrawnTile()->getLabel()}\n";
        } else {
            if ($staleMateCounter++ >= 2) {
                echo "No player can make a move, stalemate\n";
                exit();
            }
            break;
        }
    }

    $players[] = $player;
}