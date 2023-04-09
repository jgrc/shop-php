<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Symfony\Http\Transformer\Product;

use Jgrc\Shop\Domain\Product\View\ProductProjection;
use Jgrc\Shop\Infrastructure\Symfony\Http\JsonApiResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductProjectionTransformer
{
    public function __invoke(ProductProjection $product): JsonResponse
    {
        return JsonApiResponseBuilder::create()
            ->data(
                type: 'product',
                id: $product->id(),
                attributes: [
                    'name' => $product->name(),
                    'price' => $product->price(),
                ]
            )
            ->httpStatus(JsonResponse::HTTP_OK)
            ->build();
    }
}
