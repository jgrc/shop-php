<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Symfony\Http\Transformer\Product;

use Jgrc\Shop\Domain\Product\ProductNotFound;
use Jgrc\Shop\Infrastructure\Symfony\Http\JsonApiResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductNotFoundTransformer
{
    public function __invoke(ProductNotFound $exception): JsonResponse
    {
        return JsonApiResponseBuilder::create()
            ->error(
                title: $exception->getMessage(),
                code: 'product-not-found'
            )
            ->httpStatus(JsonResponse::HTTP_NOT_FOUND)
            ->build();
    }
}
