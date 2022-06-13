<?php

declare(strict_types=1);

namespace App\Rover\Application\Model\Command;

use App\Rover\Application\Factory\RoverSingletonFactory;
use App\Rover\Application\Service\RoverPositionUpdateByPosition;
use App\Rover\Domain\Position;
use App\Shared\Domain\Bus\Command\CommandHandler;

final class SetRoverInitialPositionHandler implements CommandHandler
{
    public function __construct(
        private RoverSingletonFactory $createRover,
        private RoverPositionUpdateByPosition $updateRoverPosition,
    )
    {
    }

    public function __invoke(SetRoverInitialPositionCommand $command): void
    {
        $rover = ($this->createRover)();
        $position = Position::create(
            $command->xAxis(),
            $command->yAxis(),
        );

        ($this->updateRoverPosition)($rover, $position);
    }
}