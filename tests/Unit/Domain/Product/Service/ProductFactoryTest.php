<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Domain\Product\Service;

use Jgrc\Shop\Domain\Product\Product;
use Jgrc\Shop\Domain\Product\Service\ProductFactory;
use Jgrc\Shop\Tool\Stub\DateTimeImmutableStub;
use Jgrc\Shop\Tool\Stub\Domain\Category\CategoryStub;
use Jgrc\Shop\Tool\Stub\Domain\Common\ImageStub;
use Jgrc\Shop\Tool\Stub\Domain\Common\NameStub;
use Jgrc\Shop\Tool\Stub\Domain\Common\PriceStub;
use Jgrc\Shop\Tool\Stub\Domain\Common\UuidStub;
use PHPUnit\Framework\TestCase;

class ProductFactoryTest extends TestCase
{
    private ProductFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new ProductFactory();
    }

    public function testCanBeCreatedFromValidData(): void
    {
        $id = UuidStub::random();
        $name = NameStub::random();
        $price = PriceStub::random();
        $image = ImageStub::random();
        $category = CategoryStub::random();
        $createdAt = DateTimeImmutableStub::random();
        $expected = new Product($id, $name, $price, $image, $category, $createdAt);

        $this->assertEquals($expected, $this->sut->__invoke($id, $name, $price, $image, $category, $createdAt));
    }
}
