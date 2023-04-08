<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Common\Bus;

interface CommandBus
{
    public function dispatch(Command $command): void;
}
