<?php

declare(strict_types=1);

namespace App\Rover\Application\Model\Query;

use App\Rover\Application\Factory\RoverSingletonFactory;
use App\Rover\Application\Model\Response\RoverPositionResponse;
use App\Shared\Domain\Bus\Query\QueryHandler;

final class GetRoverPositionHandler implements QueryHandler
{
    public function __construct(
        private RoverSingletonFactory $roverFactory,
    )
    {
    }

    public function __invoke(GetRoverPositionQuery $query): RoverPositionResponse
    {
        $rover = ($this->roverFactory)();
        return new RoverPositionResponse($rover->currentPosition());
    }
}