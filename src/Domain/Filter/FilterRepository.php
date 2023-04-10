<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Filter;

use Jgrc\Shop\Domain\Common\Vo\Uuid;

interface FilterRepository
{
    public function byId(Uuid $id): ?Filter;
}
