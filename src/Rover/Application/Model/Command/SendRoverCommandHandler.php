<?php

declare(strict_types=1);

namespace App\Rover\Application\Model\Command;

use App\Rover\Application\Factory\CommandCollectionFactory;
use App\Rover\Application\Factory\PlanetSingletonFactory;
use App\Rover\Application\Factory\RoverSingletonFactory;
use App\Rover\Application\Service\RoverPositionUpdater;
use App\Rover\Domain\Exception\ObstacleDetectedException;
use App\Rover\Domain\ValueObject\CommandValueObject;
use App\Shared\Domain\Bus\Command\CommandHandler;
use Psr\Log\LoggerInterface;

final class SendRoverCommandHandler implements CommandHandler
{
    public function __construct(
        private LoggerInterface $logger,
        private RoverSingletonFactory $createRover,
        private PlanetSingletonFactory $createPlanet,
        private RoverPositionUpdater $updateRoverPosition,
        private CommandCollectionFactory $createCommandCollection,
    )
    {
    }

    public function __invoke(SendRoverCommand $command): void
    {
        $rover = ($this->createRover)();
        $planet = ($this->createPlanet)();
        $commandCollection = $this->createCommandCollection->createFromArray($command->commandValues());

        /** @var CommandValueObject $nextCommand */
        foreach ($commandCollection as $nextCommand) {
            try {
                $this->notifyAction($nextCommand);

                ($this->updateRoverPosition)(
                    $nextCommand,
                    $planet,
                    $rover
                );
            } catch (ObstacleDetectedException $obstacleDetectedException) {
                $this->logger->warning(
                    'Warning! ' . $obstacleDetectedException->getMessage()
                );
            }
        }
    }

    private function notifyAction(CommandValueObject $nextCommand): void
    {
        $this->logger->notice(
            sprintf('Rover is moving to %s...', $nextCommand->beauty())
        );
    }
}