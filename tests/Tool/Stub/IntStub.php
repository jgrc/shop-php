<?php

namespace Jgrc\Shop\Tool\Stub;

class IntStub
{
    public static function between(int $min, int $max): int
    {
        return RandomGenerator::instance()->faker()->numberBetween($min, $max);
    }

    public static function positive(): int
    {
        return IntStub::between(1, PHP_INT_MAX);
    }

    public static function negative(): int
    {
        return IntStub::between(PHP_INT_MIN, -1);
    }

    public static function random(): int
    {
        return IntStub::between(PHP_INT_MIN, PHP_INT_MAX);
    }
}
