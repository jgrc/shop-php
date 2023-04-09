<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Product\Service;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Category\Category;
use Jgrc\Shop\Domain\Common\Vo\Image;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Price;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Product\Product;

class ProductFactory
{
    public function __invoke(
        Uuid $id,
        Name $name,
        Price $price,
        Image $image,
        Category $category,
        DateTimeImmutable $createdAt
    ): Product {
        return new Product($id, $name, $price, $image, $category, $createdAt);
    }
}
