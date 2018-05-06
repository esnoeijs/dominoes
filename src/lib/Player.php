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
     * Player constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->tiles = new Pile();
    }

    /**
     * @param Pile $gamePile
     * @param int $amount
     * @return bool
     */
    public function drawTile(Pile $gamePile, int $amount = 1)
    {
        while ($amount-- > 0) {
            $tile = $gamePile->getTile();
            if ($tile === null) {
                return false;
            }

            $this->tiles->addTile($tile);
        }

        return true;
    }

    /**
     * @param TileSequence $board
     * @return bool
     */
    public function hasMove(TileSequence $board) : bool
    {
        foreach ($this->tiles->getTiles() as $tile) {
            if ($board->canConnect($tile)) {
                return true;
            }
        }

        return false;
    }
}