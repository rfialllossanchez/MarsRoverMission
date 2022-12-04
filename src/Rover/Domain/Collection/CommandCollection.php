<?php

declare(strict_types=1);

namespace App\Rover\Domain\Collection;

use App\Rover\Domain\ValueObject\CommandValueObject;

final class CommandCollection extends Collection
{
    protected function isAllowedClass(object $classToBeAdded): bool
    {
        return $classToBeAdded instanceof CommandValueObject;
    }
}
