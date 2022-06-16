<?php

declare(strict_types=1);

namespace App\Tests\Unit\Rover\Application\Service;

use App\Rover\Application\Service\PlanetObstacleDetector;
use App\Rover\Application\Service\RoverPositionStrategyFactory;
use App\Rover\Application\Service\RoverPositionUpdaterByCommand;
use App\Rover\Domain\Position;
use App\Rover\Domain\Rover;
use App\Rover\Domain\ValueObject\CommandValueObject;
use App\Tests\Unit\Rover\Application\Service\Mother\PlanetMother;
use App\Tests\Unit\Rover\Application\Service\Mother\PositionMother;
use PHPUnit\Framework\TestCase;

class RoverPositionUpdaterByCommandTest extends TestCase
{
    private Rover $rover;

    protected function setUp(): void
    {
        parent::setUp();

        /**
         * To consider: in this case we are using the domain class to check expected method usage
         * in a more complex system we should mock the provided external dependency for instance
         * a database repository.
         */
        $this->rover = $this->createMock(Rover::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset(
            $this->rover
        );
    }

    /**
     * @test
     * @dataProvider updateRoverPositionWithCommandDataProvider
     */
    public function updateRoverPositionWithCommand(
        CommandValueObject $command,
        Position $nextPosition
    ): void
    {
        $planet = PlanetMother::planetWithOneObstaclesIn(
            PositionMother::positionThreeAndFive()
        );

        $this->rover->expects($this->once())
            ->method('updatePosition');

        $this->rover->method('currentPosition')
            ->willReturn($nextPosition);

        $sut = new RoverPositionUpdaterByCommand(
            new PlanetObstacleDetector(),
            new RoverPositionStrategyFactory()
        );

        $sut->__invoke(
            $command,
            $planet,
            $this->rover
        );

        $this->assertEquals($this->rover->currentPosition(), $nextPosition);
    }

    public function updateRoverPositionWithCommandDataProvider(): array
    {
        return [
            'Update Rover position to forward' => [
                'command' => CommandValueObject::createFromValue(CommandValueObject::FORWARD),
                'nextPosition' => PositionMother::positionOneAndZero()
            ],
            'Update Rover position to right' => [
                'command' => CommandValueObject::createFromValue(CommandValueObject::RIGHT),
                'nextPosition' => PositionMother::positionOneAndOne()
            ],
            'Update Rover position to left' => [
                'command' => CommandValueObject::createFromValue(CommandValueObject::LEFT),
                'nextPosition' => PositionMother::positionZeroAndOne()
            ],
        ];
    }
}