<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Application\Product;

use Jgrc\Shop\Application\Product\CreateProductHandler;
use Jgrc\Shop\Domain\Category\CategoryNotFound;
use Jgrc\Shop\Domain\Category\CategoryRepository;
use Jgrc\Shop\Domain\Common\Vo\Image;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Price;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Product\ProductAlreadyExists;
use Jgrc\Shop\Domain\Product\ProductRepository;
use Jgrc\Shop\Domain\Product\Service\ProductFactory;
use Jgrc\Shop\Tool\Stub\Application\Product\CreateProductStub;
use Jgrc\Shop\Tool\Stub\Domain\Category\CategoryStub;
use Jgrc\Shop\Tool\Stub\Domain\Product\ProductStub;
use PHPUnit\Framework\TestCase;

class CreateProductHandlerTest extends TestCase
{
    private ProductFactory $productFactory;
    private CategoryRepository $categoryRepository;
    private ProductRepository $productRepository;
    private CreateProductHandler $sut;

    protected function setUp(): void
    {
        $this->productFactory = $this->createMock(ProductFactory::class);
        $this->categoryRepository = $this->createMock(CategoryRepository::class);
        $this->productRepository = $this->createMock(ProductRepository::class);
        $this->sut = new CreateProductHandler(
            $this->productFactory,
            $this->categoryRepository,
            $this->productRepository
        );
    }

    public function testCanBeCreatedFromValidData(): void
    {
        $command = CreateProductStub::random();
        $category = CategoryStub::random();
        $product = ProductStub::random();
        $id = new Uuid($command->id());
        $name = new Name($command->name());
        $price = new Price($command->price());
        $image = new Image($command->image());
        $categoryId = new Uuid($command->categoryId());

        $this->productRepository
            ->method('byId')
            ->with($id)
            ->willReturn(null);
        $this->categoryRepository
            ->method('byId')
            ->with($categoryId)
            ->willReturn($category);
        $this->productFactory
            ->method('__invoke')
            ->with($id, $name, $price, $image, $category, $command->createdAt())
            ->willReturn($product);
        $this->productRepository
            ->expects($this->exactly(1))
            ->method('save')
            ->with($product);

        $this->sut->__invoke($command);
    }

    public function testCannotBeCreatedFromExistingId(): void
    {
        $command = CreateProductStub::random();
        $product = ProductStub::random();
        $id = new Uuid($command->id());

        $this->productRepository
            ->method('byId')
            ->with($id)
            ->willReturn($product);
        $this->productRepository
            ->expects($this->never())
            ->method('save')
            ->with($this->any());

        $this->expectException(ProductAlreadyExists::class);

        $this->sut->__invoke($command);
    }

    public function testCannotBeCreatedBecauseCategoryDoesNotExist(): void
    {
        $command = CreateProductStub::random();
        $id = new Uuid($command->id());
        $categoryId = new Uuid($command->categoryId());

        $this->productRepository
            ->method('byId')
            ->with($id)
            ->willReturn(null);
        $this->categoryRepository
            ->method('byId')
            ->with($categoryId)
            ->willReturn(null);
        $this->productRepository
            ->expects($this->never())
            ->method('save')
            ->with($this->any());

        $this->expectException(CategoryNotFound::class);

        $this->sut->__invoke($command);
    }
}
