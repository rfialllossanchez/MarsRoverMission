<?php

declare(strict_types=1);

namespace App\Rover\Domain;

final class Obstacle
{
    public function __construct(private Position $position)
    {
    }

    public static function create(Position $position): Obstacle
    {
        return new Obstacle($position);
    }

    public function position(): Position
    {
        return $this->position;
    }
}