<?php

declare(strict_types=1);

namespace integration\Rover\infrastructure;

use App\Rover\Application\Model\Response\RoverPositionResponse;
use App\Rover\Infrastructure\Controller\GetRoverPositionController;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetRoverPositionControllerTest extends KernelTestCase
{
    private QueryBus $queryBus;
    private CommandBus $commandBus;
    private LoggerInterface $logger;

    private const EXPECTED_ROVER_INITIAL_POSITION = [
        'X' => 0,
        'Y' => 0
    ];

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

    /** @test */
    public function retrieveRoverInitialPositionInZeroAndZeroCoordinates(): void
    {
        $sut = new GetRoverPositionController(
            $this->queryBus,
            $this->commandBus,
            $this->logger
        );
        $result = $sut->__invoke();

        $this->assertInstanceOf(RoverPositionResponse::class, $result);
        $this->assertEquals(
            self::EXPECTED_ROVER_INITIAL_POSITION,
            $result->toArray()
        );
    }
}