<?php

namespace Jgrc\Shop\Domain\Category;

use Jgrc\Shop\Domain\Common\Vo\Uuid;

interface CategoryRepository
{
    public function byId(Uuid $id): ?Category;
    public function save(Category $category): void;
}
