<?php

declare(strict_types=1);

namespace App\Rover\Application\Factory;

use App\Rover\Domain\Collection\CommandCollection;
use App\Rover\Domain\ValueObject\CommandValueObject;

final class CommandCollectionFactory
{
    public function createEmpty(): CommandCollection
    {
        return new CommandCollection();
    }

    public function createFromArray(array $values): CommandCollection
    {
        $collection = $this->createEmpty();
        foreach ($values as $value) {
            $collection->add(CommandValueObject::createFromValue($value));
        }

        return $collection;
    }
}