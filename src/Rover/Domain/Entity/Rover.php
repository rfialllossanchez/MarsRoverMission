<?php

declare(strict_types=1);

namespace App\Rover\Domain\Entity;

final class Rover
{
    private Position $previousPosition;

    public function __construct(private Position $currentPosition)
    {
    }

    public function previousPosition(): Position
    {
        return $this->previousPosition;
    }

    public function currentPosition(): Position
    {
        return $this->currentPosition;
    }

    public function updatePosition(Position $newPosition): void
    {
        $this->previousPosition = $this->currentPosition;
        $this->currentPosition = $newPosition;
    }
}
