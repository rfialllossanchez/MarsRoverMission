<?php

declare(strict_types=1);

namespace App\Rover\Domain\ValueObject;

class Command extends StringEnum
{
    public const FORWARD = 'f';
    public const RIGHT = 'r';
    public const LEFT = 'l';

    protected array $allowedValues = [
        self::FORWARD,
        self::RIGHT,
        self::LEFT
    ];

    protected const VALUES_MAPPING = [
        self::FORWARD => 'forward',
        self::RIGHT => 'right',
        self::LEFT => 'left'
    ];

    public static function createFromValue(string $value): CommandValueObject
    {
        return new CommandValueObject($value);
    }

    public function isForward(): bool
    {
        return $this->value === self::FORWARD;
    }

    public function isRight(): bool
    {
        return $this->value === self::RIGHT;
    }

    public function isLeft(): bool
    {
        return $this->value === self::LEFT;
    }

    public function beauty(): string
    {
        return self::VALUES_MAPPING[$this->value];
    }
}
