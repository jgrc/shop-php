<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Common\Bus;

interface EventBus
{
    public function publish(Event ...$events): void;
}
