<?php

declare(strict_types=1);

namespace App\Rover\Domain\Entity;

use App\Rover\Domain\Collection\ObstacleCollection;

final class Planet
{
    public const DEFAULT_NAME = 'Mars';
    public const DEFAULT_HORIZONTAL_SIZE = 200;
    public const DEFAULT_VERTICAL_SIZE = 200;
    public const DEFAULT_OBSTACLES = 10;

    public function __construct(
        private string $name = self::DEFAULT_NAME,
        private int $horizontalSize = self::DEFAULT_HORIZONTAL_SIZE,
        private int $verticalSize = self::DEFAULT_VERTICAL_SIZE,
        private ObstacleCollection $obstacles,
    )
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function horizontalSize(): int
    {
        return $this->horizontalSize;
    }

    public function verticalSize(): int
    {
        return $this->verticalSize;
    }

    public function obstacles(): ObstacleCollection
    {
        return $this->obstacles;
    }

    public function hasObstacleIn(Position $position): bool
    {
        /** @var Obstacle $obstacle */
        foreach ($this->obstacles as $obstacle) {
            if ($obstacle->position() == $position) {
                return true;
            }
        }
        
        return false;
    }
}