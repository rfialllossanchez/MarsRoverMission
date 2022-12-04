<?php

declare(strict_types=1);

namespace App\Rover\Domain\Collection;

use App\Rover\Domain\Obstacle;

final class ObstacleCollection extends Collection
{
    protected function isAllowedClass(object $classToBeAdded): bool
    {
        return $classToBeAdded instanceof Obstacle;
    }

    public function toArray(): array
    {
        $output = [];
        /** @var Obstacle $obstacle */
        foreach ($this->collection as $obstacle) {
            $output [] = (string)$obstacle->position();
        }

        return $output;
    }
}
