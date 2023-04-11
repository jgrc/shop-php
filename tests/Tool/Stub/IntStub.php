<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub;

class IntStub
{
    public static function between(int $min, int $max): int
    {
        return RandomGenerator::instance()->faker()->numberBetween($min, $max);
    }

    public static function positive(int $max = PHP_INT_MAX): int
    {
        return IntStub::between(1, $max);
    }

    public static function negative(int $min = PHP_INT_MIN): int
    {
        return IntStub::between($min, -1);
    }

    public static function random(): int
    {
        return IntStub::between(PHP_INT_MIN, PHP_INT_MAX);
    }
}
