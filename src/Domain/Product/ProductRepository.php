<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Product;

use Jgrc\Shop\Domain\Common\Vo\Uuid;

interface ProductRepository
{
    public function byId(Uuid $id): ?Product;
    public function save(Product $product): void;
}
