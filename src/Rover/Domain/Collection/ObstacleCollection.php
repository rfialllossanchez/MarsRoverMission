<?php

declare(strict_types=1);

namespace App\Rover\Domain\Collection;

use App\Rover\Domain\Obstacle;

final class ObstacleCollection extends Collection
{
    public static function createEmpty(): ObstacleCollection
    {
        return new ObstacleCollection();
    }

    protected function isAllowedClass(object $classToBeAdded): bool
    {
        return $classToBeAdded instanceof Obstacle;
    }
}