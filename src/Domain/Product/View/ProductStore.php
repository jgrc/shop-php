<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Product\View;

use DateTimeImmutable;

interface ProductStore
{
    public function createIndex(): void;
    public function save(ProductProjection $product, DateTimeImmutable $when): void;
}
