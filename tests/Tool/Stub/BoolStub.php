<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub;

class BoolStub
{
    public static function random(): bool
    {
        return RandomGenerator::instance()->faker()->boolean();
    }
}
