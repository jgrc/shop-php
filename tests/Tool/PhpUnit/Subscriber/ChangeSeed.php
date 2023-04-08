<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\PhpUnit\Subscriber;

use Jgrc\Shop\Tool\Stub\RandomGenerator;
use PHPUnit\Event\Test\Prepared;
use PHPUnit\Event\Test\PreparedSubscriber;

class ChangeSeed implements PreparedSubscriber
{
    public function notify(Prepared $event): void
    {
        RandomGenerator::instance()->randomSeed();
    }
}
