<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Filter;

use Jgrc\Shop\Domain\Common\Vo\Uuid;

interface FilterGroupRepository
{
    public function byId(Uuid $id): ?FilterGroup;
    public function save(FilterGroup $product): void;
}
