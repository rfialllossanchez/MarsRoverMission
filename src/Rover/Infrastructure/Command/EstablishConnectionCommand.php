<?php

declare(strict_types=1);

namespace App\Rover\Infrastructure\Command;

use App\Rover\Domain\ValueObject\CommandValueObject;
use App\Rover\Infrastructure\Controller\ExecuteCommandsController;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class EstablishConnectionCommand extends Command
{
    public function __construct(
        private LoggerInterface $logger,
        private ExecuteCommandsController $executeCommands,
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

        ($this->executeCommands)([CommandValueObject::LEFT, CommandValueObject::RIGHT]);

        $this->logger->notice('Shutting down system...');
        $this->logger->notice('Bye bye, see you next time ;)');

        return Command::SUCCESS;
    }
}