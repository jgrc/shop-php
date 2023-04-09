<?php

declare(strict_types=1);

namespace Jgrc\Shop\Application\Product;

use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Product\View\ProductProjection;
use Jgrc\Shop\Domain\Product\View\ProductView;

class GetProductByIdHandler
{
    private ProductView $productView;

    public function __construct(ProductView $productView)
    {
        $this->productView = $productView;
    }

    public function __invoke(GetProductById $query): ProductProjection
    {
        return $this->productView->byId(new Uuid($query->id()));
    }
}
