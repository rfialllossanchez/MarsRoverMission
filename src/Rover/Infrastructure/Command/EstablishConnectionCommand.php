<?php

declare(strict_types=1);

namespace App\Rover\Infrastructure\Command;

use App\Rover\Domain\ValueObject\CommandValueObject;
use App\Rover\Infrastructure\Controller\GetRoverPositionController;
use App\Rover\Infrastructure\Controller\SendRoverCommandsController;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class EstablishConnectionCommand extends Command
{
    private const AVAILABLE_OPTIONS = [
        '- Press 1 to check Rover position',
        '- Press 2 to send commands to Rover',
        '- Press 3 to finish connection'
    ];

    public function __construct(
        private LoggerInterface $logger,
        private SendRoverCommandsController $sendRoverCommands,
        private GetRoverPositionController $getRoverPosition,
    )
    {
        parent::__construct();
    }

    protected static $defaultName = 'app:establish-connection';
    protected static $defaultDescription = 'Establishes a connection with mars rovers';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->logger->notice('Initializing...');
        $this->logger->notice('Connection established successfully!');

        $this->logger->notice(
            'Available Options: ' . PHP_EOL . implode(PHP_EOL, self::AVAILABLE_OPTIONS),
        );

        $option = fread(STDIN, 1);
        while ($option != 3) {
            $this->processSelectedOption($option);
            $option = fread(STDIN, 1);
        }

//        $this->logger->notice('Shutting down system...');
//        $this->logger->notice('Bye bye, see you next time ;)');

        return Command::SUCCESS;
    }

    private function processSelectedOption(string $option): void
    {
        match ($option) {
            '1' => $this->printRoverPosition(),
            '2' => ($this->sendRoverCommands)([CommandValueObject::LEFT, CommandValueObject::RIGHT]),
            '3' => $this->logger->notice('Process option : ' . $option),
            default => $this->logger->notice('Process default option: ' . $option),
        };
    }

    private function printRoverPosition(): void
    {
        $roverPosition = ($this->getRoverPosition)();
        $this->logger->notice(
            sprintf('Current Rover coordinates are: %s', $roverPosition->toString())
        );
    }
}