<?php

declare(strict_types=1);

namespace App\Rover\Application\Factory;

use App\Rover\Domain\Collection\ObstacleCollection;
use App\Rover\Domain\Planet;

final class PlanetFactory
{
    private static ?Planet $planet = null;

    private const PLANET_DEFAULT_NAME = 'Mars';
    private const PLANET_DEFAULT_HORIZONTAL_SIZE = 200;
    private const PLANET_DEFAULT_VERTICAL_SIZE = 200;

    public function __invoke(): Planet
    {
        if (self::$planet === null) {
            $this->createPlanet();
        }

        return self::$planet;
    }

    private function createPlanet(): void
    {
        self::$planet = new Planet(
            self::PLANET_DEFAULT_NAME,
            self::PLANET_DEFAULT_HORIZONTAL_SIZE,
            self::PLANET_DEFAULT_VERTICAL_SIZE,
            ObstacleCollection::createEmpty()
        );
    }
}