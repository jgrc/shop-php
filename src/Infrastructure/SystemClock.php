<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Common\Service\Clock;

class SystemClock implements Clock
{
    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable('now');
    }
}
