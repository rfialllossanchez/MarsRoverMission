<?php

declare(strict_types=1);

namespace App\Tests\Unit\Rover\Application\Service;

use App\Rover\Application\Service\PlanetObstacleDetector;
use App\Rover\Domain\Exception\ObstacleDetectedException;
use App\Tests\Unit\Rover\Application\Service\Mother\PlanetMother;
use App\Tests\Unit\Rover\Application\Service\Mother\PositionMother;
use PHPUnit\Framework\TestCase;

class PlanetObstacleDetectorTest extends TestCase
{
    /** @test */
    public function obstacleDetectedForPosition(): void
    {
        $nextPosition = PositionMother::positionEigthAndThirteen();
        $planet = PlanetMother::planetWithOneObstaclesIn($nextPosition);

        $this->expectException(ObstacleDetectedException::class);
        $this->expectExceptionMessage(
            sprintf('Obstacle detected in position %s', (string)$nextPosition),
        );

        $sut = new PlanetObstacleDetector();

        $sut->__invoke($planet, $nextPosition);
    }
}