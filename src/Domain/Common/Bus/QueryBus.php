<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Common\Bus;

interface QueryBus
{
    public function query(Query $query): object;
}
