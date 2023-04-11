<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Application\Product;

use Jgrc\Shop\Application\Product\AddProductFiltersHandler;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Filter\FilterRepository;
use Jgrc\Shop\Domain\Product\ProductRepository;
use Jgrc\Shop\Tool\Stub\Application\Product\AddProductFiltersStub;
use Jgrc\Shop\Tool\Stub\Domain\Filter\FilterStub;
use Jgrc\Shop\Tool\Stub\Domain\Product\ProductStub;
use Jgrc\Shop\Tool\Stub\StringStub;
use PHPUnit\Framework\TestCase;

class AddProductFiltersHandlerTest extends TestCase
{
    private ProductRepository $productRepository;
    private FilterRepository $filterRepository;
    private AddProductFiltersHandler $sut;

    protected function setUp(): void
    {
        $this->productRepository = $this->createMock(ProductRepository::class);
        $this->filterRepository = $this->createMock(FilterRepository::class);
        $this->sut = new AddProductFiltersHandler($this->productRepository, $this->filterRepository);
    }

    public function testCanBeProjected(): void
    {
        $productId = StringStub::uuid();
        $filterId = StringStub::uuid();
        $command = AddProductFiltersStub::builder()
            ->withProductId($productId)
            ->withFilterIds($filterId)
            ->build();
        $product = ProductStub::random();
        $filter = FilterStub::random();

        $this->productRepository
            ->method('byId')
            ->with(new Uuid($productId))
            ->willReturn($product);
        $this->filterRepository
            ->method('byId')
            ->with(new Uuid($filterId))
            ->willReturn($filter);
        $this->productRepository
            ->expects($this->once())
            ->method('save')
            ->with($product);

        $this->sut->__invoke($command);

        $this->assertEquals(1, $product->filters()->count());
        $this->assertSame($filter, $product->filters()->first());
    }
}
