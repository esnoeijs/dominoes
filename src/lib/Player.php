<?php
declare(strict_types=1);

namespace Acme\lib;

class Player
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Pile
     */
    private $tiles;

    /**
     * @var Tile
     */
    private $lastDrawnTile;

    /**
     * Player constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->tiles = new Pile();
    }

    /**
     * @return int
     */
    public function countTiles() : int
    {
        return \count($this->tiles);
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param Pile $gamePile
     * @param int $amount
     * @return bool
     */
    public function drawTile(Pile $gamePile, int $amount = 1) : bool
    {
        while ($amount-- > 0) {
            $tile = $gamePile->getTile();
            if ($tile === null) {
                return false;
            }

            $this->lastDrawnTile = $tile;
            $this->tiles->addTile($tile);
        }

        return true;
    }

    /**
     * @return Tile
     */
    public function getLastDrawnTile() : Tile
    {
        return $this->lastDrawnTile;
    }

    /**
     * @param TileSequence $board
     * @return bool
     */
    public function makeMove(TileSequence $board) : bool
    {
        foreach ($this->tiles->getTiles() as $tile) {
            if ($board->attachBegin($tile) || $board->attachEnd($tile)) {
                $this->tiles->removeTile($tile);

                $connectedTile = $tile->getAttached(Tile::BEGIN) ?:  $tile->getAttached(Tile::END);
                echo "{$this->name} Plays {$tile->getLabel()} to connect to tile {$connectedTile->getLabel()} on the board\n";
                echo "Board is now: {$board->getSequenceAsString()}\n";

                return true;
            }
        }

        return false;
    }
}