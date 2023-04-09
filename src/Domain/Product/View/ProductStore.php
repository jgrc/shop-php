<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Product\View;

interface ProductStore
{
    public function createIndex(): void;
    public function save(ProductProjection $product): void;
}
