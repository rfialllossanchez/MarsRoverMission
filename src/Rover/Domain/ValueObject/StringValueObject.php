<?php

declare(strict_types=1);

namespace App\Rover\Domain\ValueObject;

abstract class StringValueObject
{
    public function __construct(
        protected string $value
    )
    {
    }

    public function __toString(): string
    {
        return $this->value();
    }

    public function value(): string
    {
        return $this->value;
    }
}