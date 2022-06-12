<?php

declare(strict_types=1);

namespace App\Rover\Application\Model\Response;

use App\Shared\Domain\Bus\Query\Response;

final class RoverPositionResponse implements Response
{

    public function __construct(
        private int $xAxis,
        private int $yAxis,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'X' => $this->xAxis,
            'Y' => $this->yAxis,
        ];
    }
}