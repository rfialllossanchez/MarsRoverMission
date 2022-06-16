<?php

declare(strict_types=1);

namespace App\Tests\Unit\Rover\Domain\ValueObject;

use App\Rover\Domain\Exception\InvalidEnumValueException;
use App\Rover\Domain\ValueObject\CommandValueObject;
use PHPUnit\Framework\TestCase;

class CommandValueObjectTest extends TestCase
{
    /**
     * @test
     * @dataProvider canBeCreatedWithAllowedTypesDataProvider
     */
    public function canBeCreatedWithAllowedTypes(string $providedCommandType): void
    {
        $sut = CommandValueObject::createFromValue($providedCommandType);

        $this->assertInstanceOf(CommandValueObject::class, $sut);
    }

    /** @test */
    public function cannotBeCreatedForWrongProvidedType(): void
    {
        $this->expectException(InvalidEnumValueException::class);
        $this->expectExceptionMessage('Value not_supported is not supported');

        CommandValueObject::createFromValue('not_supported');
    }

    public function canBeCreatedWithAllowedTypesDataProvider(): array
    {
        return [
            'FORWARD' => [
                'type' => CommandValueObject::FORWARD,
            ],
            'RIGHT' => [
                'type' => CommandValueObject::RIGHT,
            ],
            'LEFT' => [
                'type' => CommandValueObject::LEFT,
            ]
        ];
    }
}