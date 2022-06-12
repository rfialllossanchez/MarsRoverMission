<?php

declare(strict_types=1);

namespace App\Rover\Application\Service;

use App\Rover\Domain\Planet;
use App\Rover\Domain\Rover;
use App\Rover\Domain\ValueObject\CommandValueObject;

final class RoverPositionUpdater
{
    public function __construct(
        private PlanetObstacleDetector $detectObstacle,
        private RoverPositionStrategyFactory $createPositionFor
    )
    {
    }

    public function __invoke(
        CommandValueObject $command,
        Planet $planet,
        Rover $rover,
    ): void
    {
        $nextPosition = ($this->createPositionFor)($rover, $command);
        ($this->detectObstacle)($planet, $nextPosition);
        $rover->updatePosition($nextPosition);
    }
}