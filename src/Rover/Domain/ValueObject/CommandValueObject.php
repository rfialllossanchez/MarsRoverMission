<?php

declare(strict_types=1);

namespace App\Rover\Domain\ValueObject;

class CommandValueObject extends StringValueObject
{
    public const FORWARD = 'f';
    public const RIGHT = 'r';
    public const LEFT = 'l';

    public const VALUES_MAPPING = [
        'f' => 'forward',
        'r' => 'right',
        'l' => 'left'
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