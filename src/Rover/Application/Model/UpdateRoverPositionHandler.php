<?php

declare(strict_types=1);

namespace App\Rover\Application\Model;

use App\Rover\Application\Factory\CommandCollectionFactory;
use App\Rover\Application\Factory\PlanetFactory;
use App\Rover\Application\Factory\RoverFactory;
use App\Rover\Application\Service\RoverPositionUpdater;
use App\Rover\Domain\ValueObject\CommandValueObject;
use App\Shared\Domain\Bus\Command\CommandHandler;
use Psr\Log\LoggerInterface;

final class UpdateRoverPositionHandler implements CommandHandler
{
    public function __construct(
        private LoggerInterface $logger,
        private RoverFactory $roverFactory,
        private PlanetFactory $planetFactory,
        private RoverPositionUpdater $updateRoverPosition,
        private CommandCollectionFactory $createCommandCollection,
    )
    {
    }

    public function __invoke(UpdateRoverPositionCommand $command): void
    {
        $rover = ($this->roverFactory)();
        $planet = ($this->planetFactory)();
        $commandCollection = $this->createCommandCollection->createFromArray($command->commandValues());

        /** @var CommandValueObject $nextCommand */
        foreach ($commandCollection as $nextCommand) {
            $this->logger->notice(
                sprintf('Updating Rover position: [%s]', (string)$nextCommand)
            );

            ($this->updateRoverPosition)(
                $nextCommand,
                $planet,
                $rover
            );
        }
    }
}