<?php

declare(strict_types=1);

namespace App\Tests\Unit\Rover\Application\Service\Mother;

use App\Rover\Domain\Collection\ObstacleCollection;
use App\Rover\Domain\Obstacle;
use App\Rover\Domain\Position;

class ObstacleCollectionMother
{
    public static function emptyCollection(): ObstacleCollection
    {
        return new ObstacleCollection();
    }

    public static function collectionWithOneObstacleIn(Position $position): ObstacleCollection
    {
        $collection = self::emptyCollection();

        $collection->add(Obstacle::create($position));

        return $collection;
    }

    public static function collectionWithThreeObstacles(): ObstacleCollection
    {
        $collection = self::emptyCollection();

        $collection->add(
            Obstacle::create(PositionMother::positionOneAndOne())
        );
        $collection->add(
            Obstacle::create(PositionMother::positionZeroAndOne())
        );
        $collection->add(
            Obstacle::create(PositionMother::positionOneAndTwo())
        );

        return $collection;
    }
}