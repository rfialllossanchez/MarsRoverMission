<?php

declare(strict_types=1);

namespace App\Rover\Infrastructure\Console;

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

    private bool $isSystemRunning = false;

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
        $this->printIntro();
        $this->isSystemRunning = true;
        $this->printAvailableOptions();

        do {
            $selectedOption = readline('Select one option: ');
            $this->processSelectedOption($selectedOption);
        } while ($this->isSystemRunning);

        return Command::SUCCESS;
    }

    private function processSelectedOption(string $option): void
    {
        match ($option) {
            '1' => $this->printRoverPosition(),
            '2' => $this->sendRoverCommands(),
            '3' => $this->shutDownConnection(),
            default => $this->printAvailableOptions(),
        };
    }

    private function printIntro(): void
    {
        $this->logger->notice('_  _ ____ ____ ____    ____ ____ _  _ ____ ____    _  _ _ ____ ____ _ ____ _  _');
        $this->logger->notice('|\/| |__| |__/ [__     |__/ |  | |  | |___ |__/    |\/| | [__  [__  | |  | |\ |');
        $this->logger->notice('|  | |  | |  \ ___]    |  \ |__|  \/  |___ |  \    |  | | ___] ___] | |__| | \|');
        $this->logger->notice('_  _ ____ ____ ____    ____ ____ _  _ ____ ____    _  _ _ ____ ____ _ ____ _  _');
        $this->logger->notice('Initializing...');
        $this->logger->notice('Connection established successfully!');
    }

    private function printAvailableOptions(): void
    {
        $this->logger->notice('Available options: ');
        foreach (self::AVAILABLE_OPTIONS as $option) {
            $this->logger->notice($option);
        }
        $this->logger->notice('');
    }

    private function printRoverPosition(): void
    {
        $roverPosition = ($this->getRoverPosition)();
        $this->logger->notice(
            sprintf('Current Rover coordinates are: %s', $roverPosition->toString())
        );
    }

    private function sendRoverCommands(): void
    {
        $commands = readline('Enter commands: [F, L, R]: ');

        ($this->sendRoverCommands)(str_split($commands));
        $this->printRoverPosition();
    }

    private function shutDownConnection(): void
    {
        $this->logger->notice('Shutting down system...');
        $this->logger->notice('Bye bye, see you next time ;)');
        $this->isSystemRunning = false;
    }
}