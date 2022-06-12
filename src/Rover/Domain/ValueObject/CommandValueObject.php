<?php

declare(strict_types=1);

namespace App\Rover\Domain\ValueObject;

class CommandValueObject extends StringValueObject
{
    public const FRONT = 'f';
    public const RIGHT = 'r';
    public const LEFT = 'l';

    public static function createFromValue(string $value): CommandValueObject
    {
        return new CommandValueObject($value);
    }

    public function isFront(): bool
    {
        return $this->value === self::FRONT;
    }

    public function isRight(): bool
    {
        return $this->value === self::RIGHT;
    }

    public function isLeft(): bool
    {
        return $this->value === self::LEFT;
    }
}