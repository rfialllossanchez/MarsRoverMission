<?php

declare(strict_types=1);

namespace App\Rover\Application\Service;

use App\Rover\Domain\Exception\InvalidCommandException;
use App\Rover\Domain\Position;
use App\Rover\Domain\Rover;
use App\Rover\Domain\ValueObject\CommandValueObject;

final class RoverPositionStrategyFactory
{
    public function __invoke(Rover $rover, CommandValueObject $command): Position
    {
        if ($command->isFront()) {
            return Position::create(
                $rover->currentPosition()->xAxis(),
                $rover->currentPosition()->yAxis() + 1,
            );
        }
        if ($command->isRight()) {
            return Position::create(
                $rover->currentPosition()->xAxis() + 1,
                $rover->currentPosition()->yAxis(),
            );
        }
        if ($command->isLeft()) {
            return Position::create(
                $rover->currentPosition()->xAxis() - 1,
                $rover->currentPosition()->yAxis(),
            );
        }

        return throw new InvalidCommandException($command);
    }
}