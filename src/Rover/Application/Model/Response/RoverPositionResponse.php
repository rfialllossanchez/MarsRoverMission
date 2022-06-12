<?php

declare(strict_types=1);

namespace App\Rover\Application\Model\Response;

use App\Rover\Domain\Position;
use App\Shared\Domain\Bus\Query\Response;

final class RoverPositionResponse implements Response
{

    public function __construct(
        private Position $position,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'X' => $this->position->xAxis(),
            'Y' => $this->position->yAxis(),
        ];
    }

    public function toString(): string
    {
        return (string)$this->position;
    }
}