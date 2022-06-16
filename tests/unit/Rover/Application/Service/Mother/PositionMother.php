<?php

declare(strict_types=1);

namespace App\Tests\Unit\Rover\Application\Service\Mother;

use App\Rover\Domain\Position;

class PositionMother
{
    public static function PositionThreeAndFive(): Position
    {
        return Position::create(3, 5);
    }

    public static function PositionEigthAndThirteen(): Position
    {
        return Position::create(8, 13);
    }

    public static function PositionTwentyFirstAndThrityFour(): Position
    {
        return Position::create(21, 34);
    }

    public static function PositionFiftyFiveAndEihtyNine(): Position
    {
        return Position::create(55, 89);
    }
}