<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Util;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Common\Service\Clock;

class FakeClock implements Clock
{
    private ?DateTimeImmutable $now;

    public function __construct()
    {
        $this->now = null;
    }

    public function setNow(DateTimeImmutable $now): void
    {
        $this->now = $now;
    }

    public function now(): DateTimeImmutable
    {
        return $this->now ?? new DateTimeImmutable('now');
    }
}
