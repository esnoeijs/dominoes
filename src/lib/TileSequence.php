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
            if ($this->begin->canAttach($side, $tile)) {
                if ($this->begin->isReversed()) {
                    if ($tile->getSpots(Tile::END) !== $this->begin->getSpots(Tile::END)) {
                        $tile->setReverse();
                    }
                } else {
                    if ($tile->getSpots(Tile::END) !== $this->begin->getSpots(Tile::BEGIN)) {
                        $tile->setReverse();
                    }
                }

                $this->begin->attach($side, $tile);
                $tile->attach($side === Tile::END ? Tile::BEGIN : Tile::END, $this->begin);

                $this->begin = $tile;
                array_unshift($this->items, $tile);

                return true;
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
            if ($this->end->canAttach($side, $tile)) {
                if ($this->end->isReversed()) {
                    if ($tile->getSpots(Tile::BEGIN) !== $this->end->getSpots(Tile::BEGIN)) {
                        $tile->setReverse();
                    }
                } else {
                    if ($tile->getSpots(Tile::BEGIN) !== $this->end->getSpots(Tile::END)) {
                        $tile->setReverse();
                    }
                }

                $this->end->attach($side, $tile);
                $tile->attach($side === Tile::END ? Tile::BEGIN : Tile::END, $this->end);

                $this->end = $tile;
                array_push($this->items, $tile);

                return true;
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
            if ($this->begin->canAttach($side, $tile) || $this->end->canAttach($side, $tile)) {
                return true;
            }
        }

        return false;
    }
}