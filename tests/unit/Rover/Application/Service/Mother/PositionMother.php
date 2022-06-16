<?php

declare(strict_types=1);

namespace App\Tests\Unit\Rover\Application\Service\Mother;

use App\Rover\Domain\Position;

class PositionMother
{
    public static function positionZeroAndOne(): Position
    {
        return Position::create(0, 1);
    }

    public static function positionOneAndOne(): Position
    {
        return Position::create(1, 1);
    }

    public static function positionOneAndTwo(): Position
    {
        return Position::create(1, 2);
    }

    public static function positionThreeAndFive(): Position
    {
        return Position::create(3, 5);
    }

    public static function positionEigthAndThirteen(): Position
    {
        return Position::create(8, 13);
    }

    public static function positionTwentyFirstAndThrityFour(): Position
    {
        return Position::create(21, 34);
    }

    public static function positionFiftyFiveAndEihtyNine(): Position
    {
        return Position::create(55, 89);
    }
}