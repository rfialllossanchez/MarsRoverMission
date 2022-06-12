<?php

declare(strict_types=1);

namespace App\Rover\Application\Factory;

use App\Rover\Domain\Position;
use App\Rover\Domain\Rover;

final class RoverFactory
{
    private static ?Rover $rover = null;
    private const INITIAL_XAXIS_POSITION = 0;
    private const INITIAL_yAXIS_POSITION = 0;

    public function __invoke(): Rover
    {
        if (self::$rover === null) {
            $this->createRover();
        }

        return self::$rover;
    }

    private function createRover(): void
    {
        self::$rover = new Rover(
            Position::create(
                self::INITIAL_XAXIS_POSITION,
                self::INITIAL_yAXIS_POSITION,
            )
        );
    }
}