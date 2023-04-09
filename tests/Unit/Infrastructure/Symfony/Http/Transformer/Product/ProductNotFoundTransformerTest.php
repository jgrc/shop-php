<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Infrastructure\Symfony\Http\Transformer\Product;

use Jgrc\Shop\Domain\Product\ProductNotFound;
use Jgrc\Shop\Infrastructure\Symfony\Http\Transformer\Product\ProductNotFoundTransformer;
use Jgrc\Shop\Tool\Stub\Domain\Common\UuidStub;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductNotFoundTransformerTest extends TestCase
{
    private ProductNotFoundTransformer $sut;

    protected function setUp(): void
    {
        $this->sut = new ProductNotFoundTransformer();
    }

    public function testJsonApiResponseCanBeCreated(): void
    {
        $id = UuidStub::random();
        $exception = ProductNotFound::fromId($id);
        $expected = new JsonResponse(
            [
                'errors' => [
                    [
                        'title' => $exception->getMessage(),
                        'code' => 'product-not-found'
                    ]
                ]
            ],
            404
        );

        $this->assertEquals($expected, $this->sut->__invoke($exception));
    }
}
