<?php

declare(strict_types=1);

namespace App\Rover\Domain\Exception;

use App\Rover\Domain\ValueObject\CommandValueObject;
use DomainException;
use Throwable;

final class InvalidCommandException extends DomainException
{
    public function __construct(CommandValueObject $command, ?Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Given command [%s] is not valid', (string) $command),
            0,
            $previous
        );
    }
}