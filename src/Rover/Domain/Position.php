<?php

declare(strict_types=1);

namespace App\Rover\Domain;

final class Position
{
    public function __construct(
        private int $xAxis,
        private int $yAxis
    )
    {
    }

    public static function create(int $xAxis, int $yAxis): Position
    {
        return new Position($xAxis, $yAxis);
    }

    public function xAxis(): int
    {
        return $this->xAxis;
    }

    public function yAxis(): int
    {
        return $this->yAxis;
    }

    public function __toString(): string
    {
        return sprintf('(%d,%d)', $this->xAxis, $this->yAxis);
    }
}