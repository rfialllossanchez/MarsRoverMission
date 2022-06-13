<?php

declare(strict_types=1);

namespace App\Rover\Application\Model\Response;

use App\Rover\Domain\Planet;
use App\Shared\Domain\Bus\Query\Response;

final class PlanetDetailsResponse implements Response
{
    public function __construct(private Planet $planet)
    {
    }

    public function toArray(): array
    {
        return [
            'Name' => $this->planet->name(),
            'HorizontalSize' => $this->planet->horizontalSize(),
            'VerticalSize' => $this->planet->verticalSize(),
            'ObstaclesPosition' => $this->planet->obstacles()->toArray(),
        ];
    }

    public function toString(): string
    {
        return sprintf(
            'Planet %s size %dx%d has obstacles in positions: %s',
            $this->planet->name(),
            $this->planet->horizontalSize(),
            $this->planet->verticalSize(),
            implode(' - ', $this->planet->obstacles()->toArray())
        );
    }
}