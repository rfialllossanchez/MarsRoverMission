<?php

declare(strict_types=1);

namespace App\Rover\Application\Service;

use App\Rover\Domain\Position;
use App\Rover\Domain\Rover;

final class RoverPositionUpdateByPosition
{
    public function __invoke(Rover $rover, Position $position): void
    {
        $rover->updatePosition($position);
    }
}