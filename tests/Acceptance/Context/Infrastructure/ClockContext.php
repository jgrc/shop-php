<?php

declare(strict_types=1);

namespace Jgrc\Shop\Acceptance\Context\Infrastructure;

use Behat\Behat\Context\Context;
use DateTimeImmutable;
use Jgrc\Shop\Tool\Util\FakeClock;

class ClockContext implements Context
{
    private FakeClock $fakeClock;

    public function __construct(FakeClock $fakeClock)
    {
        $this->fakeClock = $fakeClock;
    }

    /** @Given it is :date now */
    public function itIsNow(string $date): void
    {
        $this->fakeClock->setNow(new DateTimeImmutable($date));
    }
}
