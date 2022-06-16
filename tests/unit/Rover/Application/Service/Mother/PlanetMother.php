<?php

declare(strict_types=1);

namespace App\Tests\Unit\Rover\Application\Service\Mother;

use App\Rover\Domain\Collection\ObstacleCollection;
use App\Rover\Domain\Obstacle;
use App\Rover\Domain\Planet;
use App\Rover\Domain\Position;

class PlanetMother
{
    public static function planetWithoutObstacles(): Planet
    {
        return new Planet(
            Planet::DEFAULT_NAME,
            Planet::DEFAULT_HORIZONTAL_SIZE,
            Planet::DEFAULT_VERTICAL_SIZE,
            ObstacleCollectionMother::emptyCollection(),
        );
    }

    public static function planetWithOneObstaclesIn(Position $position): Planet
    {
        return new Planet(
            Planet::DEFAULT_NAME,
            Planet::DEFAULT_HORIZONTAL_SIZE,
            Planet::DEFAULT_VERTICAL_SIZE,
            ObstacleCollectionMother::collectionWithOneObstacleIn($position),
        );
    }


    public static function planetWithThreeObstacles(): Planet
    {
        return new Planet(
            Planet::DEFAULT_NAME,
            Planet::DEFAULT_HORIZONTAL_SIZE,
            Planet::DEFAULT_VERTICAL_SIZE,
            ObstacleCollectionMother::collectionWithThreeObstacles(),
        );
    }
}