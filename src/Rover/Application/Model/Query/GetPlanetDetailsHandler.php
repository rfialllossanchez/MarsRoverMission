<?php

declare(strict_types=1);

namespace App\Rover\Application\Model\Query;

use App\Rover\Application\Factory\PlanetSingletonFactory;
use App\Rover\Application\Model\Response\PlanetDetailsResponse;
use App\Shared\Domain\Bus\Query\QueryHandler;

final class GetPlanetDetailsHandler implements QueryHandler
{
    public function __construct(
        private PlanetSingletonFactory $createPlanet,
    )
    {
    }

    public function __invoke(GetPlanetDetailsQuery $query): PlanetDetailsResponse
    {
        $planet = ($this->createPlanet)();
        return new PlanetDetailsResponse($planet);
    }
}