<?php

declare(strict_types=1);

namespace App\Rover\Application\Service;

use App\Rover\Domain\Exception\ObstacleDetectedException;
use App\Rover\Domain\Planet;
use App\Rover\Domain\Position;

class PlanetObstacleDetector
{
    public function __invoke(
        Planet $planet,
        Position $nextPosition,
    ): void
    {
        if ($planet->hasObstacleIn($nextPosition)) {
            throw new ObstacleDetectedException($nextPosition);
        }
    }
}
