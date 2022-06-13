<?php

declare(strict_types=1);

namespace App\Rover\Application\Model\Command;

use App\Shared\Domain\Bus\Command\Command;

final class SetRoverInitialPositionCommand implements Command
{
    public function __construct(
        private int $xAxis,
        private int $yAxis,
    )
    {
    }

    public function xAxis(): int
    {
        return $this->xAxis;
    }

    public function yAxis(): int
    {
        return $this->yAxis;
    }
}