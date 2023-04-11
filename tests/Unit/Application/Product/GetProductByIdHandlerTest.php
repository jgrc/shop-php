<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Application\Product;

use Jgrc\Shop\Application\Product\GetProductByIdHandler;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Product\View\ProductView;
use Jgrc\Shop\Tool\Stub\Application\Product\GetProductByIdStub;
use Jgrc\Shop\Tool\Stub\Domain\Product\ProductProjectionStub;
use PHPUnit\Framework\TestCase;

class GetProductByIdHandlerTest extends TestCase
{
    private ProductView $productView;
    private GetProductByIdHandler $sut;

    protected function setUp(): void
    {
        $this->productView = $this->createMock(ProductView::class);
        $this->sut = new GetProductByIdHandler($this->productView);
    }

    public function testCanBeProjected(): void
    {
        $query = GetProductByIdStub::random();
        $productProjection = ProductProjectionStub::random();

        $this->productView
            ->method('byId')
            ->with(new Uuid($query->id()))
            ->willReturn($productProjection);

        $this->assertSame($productProjection, $this->sut->__invoke($query));
    }
}
