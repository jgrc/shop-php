<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Symfony\Http\Transformer\Product;

use Jgrc\Shop\Domain\Filter\View\FilterGroupProjection;
use Jgrc\Shop\Domain\Filter\View\FilterProjection;
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
                    'image' => $product->image(),
                    'enabled' => $product->enabled(),
                    'created_at' => $product->createdAt()->format(DATE_ATOM),
                    'category' => [
                        'id' => $product->category()->id(),
                        'name' => $product->category()->name(),
                    ],
                    'filter_groups' => array_map(
                        fn(FilterGroupProjection $filterGroup): array => [
                            'id' => $filterGroup->id(),
                            'name' => $filterGroup->name(),
                            'filters' => array_map(
                                fn(FilterProjection $filter): array => [
                                    'id' => $filter->id(),
                                    'name' => $filter->name()
                                ],
                                $filterGroup->filters()
                            )
                        ],
                        $product->filterGroups()
                    )
                ]
            )
            ->httpStatus(JsonResponse::HTTP_OK)
            ->build();
    }
}
