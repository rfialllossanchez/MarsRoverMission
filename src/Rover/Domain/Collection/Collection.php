<?php

declare(strict_types=1);

namespace App\Rover\Domain\Collection;

use Countable;
use Iterator;
use UnexpectedValueException;

abstract class Collection implements Iterator, Countable
{
    protected array $collection = [];
    private int $currentIndex = 0;

    public function add(object $item): void
    {
        $this->ensureIsValidItem($item);
        $this->collection[] = $item;
    }

    abstract protected function isAllowedClass(object $classToBeAdded): bool;

    private function ensureIsValidItem(object $item): void
    {
        if (!$this->isAllowedClass($item)) {
            throw new UnexpectedValueException(
                sprintf('Class %s is not allowed in this collection.', get_class($item))
            );
        }
    }

    public function current(): mixed
    {
        return $this->collection[$this->currentIndex];
    }

    public function next(): void
    {
        ++$this->currentIndex;
    }

    public function key(): mixed
    {
        return $this->currentIndex;
    }

    public function valid(): bool
    {
        return isset($this->collection[$this->currentIndex]);
    }

    public function rewind(): void
    {
        $this->currentIndex = 0;
    }

    public function count(): int
    {
        return count($this->collection);
    }
}