<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Infrastructure\Symfony\Http\Transformer\Product;

use Jgrc\Shop\Domain\Filter\View\FilterGroupProjection;
use Jgrc\Shop\Domain\Filter\View\FilterProjection;
use Jgrc\Shop\Infrastructure\Symfony\Http\Transformer\Product\ProductProjectionTransformer;
use Jgrc\Shop\Tool\Stub\Domain\Product\ProductProjectionStub;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductProjectionTransformerTest extends TestCase
{
    private ProductProjectionTransformer $sut;

    protected function setUp(): void
    {
        $this->sut = new ProductProjectionTransformer();
    }

    public function testJsonApiResponseCanBeCreated(): void
    {
        $productProjection = ProductProjectionStub::random();
        $expected = new JsonResponse(
            [
                'data' => [
                    'type' => 'product',
                    'id' => $productProjection->id(),
                    'attributes' => [
                        'name' => $productProjection->name(),
                        'price' => $productProjection->price(),
                        'image' => $productProjection->image(),
                        'enabled' => $productProjection->enabled(),
                        'created_at' => $productProjection->createdAt()->format(DATE_ATOM),
                        'category' => [
                            'id' => $productProjection->category()->id(),
                            'name' => $productProjection->category()->name(),
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
                            $productProjection->filterGroups()
                        )
                    ]
                ]
            ],
            200
        );

        $this->assertEquals($expected, $this->sut->__invoke($productProjection));
    }
}
