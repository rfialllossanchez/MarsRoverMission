<?php

declare(strict_types=1);

namespace App\Rover\Application\Model\Command;

use App\Shared\Domain\Bus\Command\Command;

final class SendRoverCommand implements Command
{
    public function __construct(
        private array $commandValues
    )
    {
    }

    public function commandValues(): array
    {
        return $this->commandValues;
    }
}