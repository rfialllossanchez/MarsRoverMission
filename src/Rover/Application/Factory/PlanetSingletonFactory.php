<?php

declare(strict_types=1);

namespace App\Rover\Application\Factory;

use App\Rover\Domain\Collection\ObstacleCollection;
use App\Rover\Domain\Planet;

final class PlanetSingletonFactory
{
    private static ?Planet $planet = null;

    public function __construct(
        private ObstacleCollectionFactory $obstaclesFactory
    )
    {
    }

    public function __invoke(): Planet
    {
        if (self::$planet === null) {
            $this->createPlanetWithObstacles();
        }

        return self::$planet;
    }

    private function createPlanetWithObstacles(): void
    {
        $obstacles = $this->obstaclesFactory->createForPlanet(
            Planet::DEFAULT_HORIZONTAL_SIZE,
            Planet::DEFAULT_VERTICAL_SIZE
        );

        self::$planet = new Planet(
            Planet::DEFAULT_NAME,
            Planet::DEFAULT_HORIZONTAL_SIZE,
            Planet::DEFAULT_VERTICAL_SIZE,
            $obstacles
        );
    }
}