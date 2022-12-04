<?php

declare(strict_types=1);

namespace App\Rover\Domain\ValueObject;

use App\Rover\Domain\Exception\InvalidEnumValueException;

abstract class StringEnum
{
    /** @var string[] */
    protected array $allowedValues = [];
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;

        $this->ensureValueIsAllowed();
    }

    public function __toString(): string
    {
        return $this->value();
    }

    public function value(): string
    {
        return $this->value;
    }

    private function ensureValueIsAllowed(): void
    {
        if (!in_array($this->value, $this->allowedValues)) {
            throw new InvalidEnumValueException("Value {$this->value} is not supported.");
        }
    }
}
