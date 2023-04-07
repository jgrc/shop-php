<?php

namespace Jgrc\Shop\Tool\Stub;

class StringStub
{
    public static function word(int $number = 1): string
    {
        return RandomGenerator::instance()->faker()->words($number, true);
    }

    public static function uuid(): string
    {
        return RandomGenerator::instance()->faker()->uuid();
    }

    public static function email(): string
    {
        return RandomGenerator::instance()->faker()->email();
    }

    public static function url(): string
    {
        return RandomGenerator::instance()->faker()->url();
    }
}
