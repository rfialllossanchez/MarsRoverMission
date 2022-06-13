<?php

declare(strict_types=1);

namespace App\Rover\Domain\Exception;

use App\Rover\Domain\Position;
use DomainException;
use Throwable;

final class ObstacleDetectedException extends DomainException
{
    public function __construct(
        Position $position,
        ?Throwable $previous = null
    )
    {
        parent::__construct(
            sprintf('Obstacle detected in position %s', (string)$position),
            0,
            $previous
        );
    }
}