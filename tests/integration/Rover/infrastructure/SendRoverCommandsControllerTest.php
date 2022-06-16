<?php

declare(strict_types=1);

namespace integration\Rover\infrastructure;

use App\Rover\Application\Model\Response\RoverPositionResponse;
use App\Rover\Domain\ValueObject\CommandValueObject;
use App\Rover\Infrastructure\Controller\GetRoverPositionController;
use App\Rover\Infrastructure\Controller\SendRoverCommandsController;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SendRoverCommandsControllerTest extends KernelTestCase
{
    private QueryBus $queryBus;
    private CommandBus $commandBus;
    private LoggerInterface $logger;

    protected function setUp(): void
    {
        parent::setUp();

        $this->queryBus = $this->getContainer()
            ->get(QueryBus::class);

        $this->commandBus = $this->getContainer()
            ->get(CommandBus::class);

        $this->logger = $this->getContainer()
            ->get(LoggerInterface::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset(
            $this->queryBus,
            $this->commandBus,
            $this->logger
        );
    }

    /**
     * @test
     * @dataProvider sendCommandsToRoverDataProvider
     */
    public function sendCommandsToRover(
        array $commands,
        array $expectedResult
    ): void
    {
        $sut = new SendRoverCommandsController(
            $this->queryBus,
            $this->commandBus,
            $this->logger
        );

        $sut->__invoke($commands);

        $roverPositionController = new GetRoverPositionController(
            $this->queryBus,
            $this->commandBus,
            $this->logger
        );

        $result = $roverPositionController->__invoke();

        $this->assertEquals(
            $result->toArray(),
            $expectedResult
        );
    }

    public function sendCommandsToRoverDataProvider(): array
    {
        return [
            'Update Rover position to (2,2)' => [
                'commands' => [
                    CommandValueObject::FORWARD,
                    CommandValueObject::RIGHT,
                    CommandValueObject::FORWARD,
                    CommandValueObject::RIGHT,
                ],
                'expectedResult' => [
                    'X' => 2,
                    'Y' => 2
                ]
            ],
            'Update Rover position to (3,3)' => [
                'commands' => [
                    CommandValueObject::RIGHT,
                    CommandValueObject::RIGHT,
                    CommandValueObject::FORWARD,
                    CommandValueObject::LEFT,
                ],
                'expectedResult' => [
                    'X' => 3,
                    'Y' => 3
                ]
            ],
            'Update Rover position to (4,4)' => [
                'commands' => [
                    CommandValueObject::LEFT,
                    CommandValueObject::RIGHT,
                    CommandValueObject::RIGHT,
                    CommandValueObject::FORWARD,
                ],
                'expectedResult' => [
                    'X' => 4,
                    'Y' => 4
                ]
            ],
        ];
    }
}