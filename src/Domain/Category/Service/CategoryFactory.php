<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Category\Service;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Category\Category;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class CategoryFactory
{
    public function __invoke(Uuid $id, Name $name, DateTimeImmutable $createdAt): Category
    {
        return new Category($id, $name, $createdAt);
    }
}
