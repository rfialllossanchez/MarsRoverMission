<?php

declare(strict_types=1);

namespace App\Rover\Application\Factory;

use App\Rover\Domain\Collection\ObstacleCollection;
use App\Rover\Domain\Obstacle;
use App\Rover\Domain\Planet;
use App\Rover\Domain\Position;

final class ObstacleCollectionFactory
{
    public function createEmpty(): ObstacleCollection
    {
        return new ObstacleCollection();
    }

    public function createForPlanet(
        int $planetMaxHorizontalSize,
        int $planetMaxVerticalSize,
    ): ObstacleCollection
    {
        $collection = $this->createEmpty();
        $total = random_int(0, Planet::DEFAULT_OBSTACLES);

        for ($current = 0; $current < $total; $current++) {
            $position = Position::create(
                random_int(0, $planetMaxHorizontalSize),
                random_int(0, $planetMaxVerticalSize)
            );

            $collection->add(
                Obstacle::create($position)
            );
        }

        return $collection;
    }
}