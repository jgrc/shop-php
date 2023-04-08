<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub;

use DateTimeImmutable;

class DateTimeImmutableStub
{
    public static function random(): DateTimeImmutable
    {
        return DateTimeImmutable::createFromMutable(RandomGenerator::instance()->faker()->dateTime());
    }
}
