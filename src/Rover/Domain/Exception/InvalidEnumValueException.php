<?php

declare(strict_types=1);

namespace App\Rover\Domain\Exception;

use DomainException;
use Throwable;

final class InvalidEnumValueException extends DomainException
{
    public function __construct($message, Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}