<?php
declare(strict_types=1);

namespace Acme\lib;

class TileSequence
{
    private $items = [];
    /**
     * @var Tile
     */
    private $begin;
    /**
     * @var Tile
     */
    private $end;

    /**
     * @param Tile $tile
     */
    public function addFirstPiece(Tile $tile)
    {
        $this->items[] = $this->begin = $this->end = $tile;
    }

    /**
     * @return Tile
     */
    public function getBegin() : Tile
    {
        return $this->begin;
    }

    /**
     * @return Tile
     */
    public function getEnd() : Tile
    {
        return $this->end;
    }

    /**
     * Returns the full sequence of tiles
     *
     * @return string
     */
    public function getSequenceAsString() : string
    {
        return implode(' ', array_map(function (Tile $tile) { return $tile->getLabel(); }, $this->items));
    }

    /**
     * @param Tile $tile
     * @return bool
     */
    public function attachBegin(Tile $tile) : bool
    {
        foreach ([Tile::BEGIN, Tile::END] as $side) {
            if ($tile->canAttach($side, $this->begin)) {
                $tile->attach($side, $this->begin);
                $this->begin = $tile;
                array_unshift($this->items, $tile);
            }
        }

        return false;
    }

    /**
     * @param Tile $tile
     * @return bool
     */
    public function attachEnd(Tile $tile) : bool
    {
        foreach ([Tile::BEGIN, Tile::END] as $side) {
            if ($tile->canAttach($side, $this->end)) {
                $tile->attach($side, $this->end);
                $this->end = $tile;
                array_push($this->items, $tile);
            }
        }

        return false;
    }

    /**
     * @param Tile $tile
     * @return bool
     */
    public function canConnect(Tile $tile) : bool
    {
        foreach ([Tile::BEGIN, Tile::END] as $side) {
            /** @var Tile $sequenceTile */
            foreach ([$this->begin, $this->end] as $sequenceTile) {
                if ($sequenceTile->canAttach($side, $tile)) {
                    return true;
                }
            }
        }

        return false;
    }
}