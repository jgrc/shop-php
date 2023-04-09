<?php

declare(strict_types=1);

namespace Jgrc\Shop\Application\Product;

use Jgrc\Shop\Domain\Category\Category;
use Jgrc\Shop\Domain\Category\CategoryNotFound;
use Jgrc\Shop\Domain\Category\CategoryRepository;
use Jgrc\Shop\Domain\Common\Vo\Image;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Price;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Product\ProductAlreadyExists;
use Jgrc\Shop\Domain\Product\ProductRepository;
use Jgrc\Shop\Domain\Product\Service\ProductFactory;

class CreateProductHandler
{
    private ProductFactory $productFactory;
    private CategoryRepository $categoryRepository;
    private ProductRepository $productRepository;

    public function __construct(
        ProductFactory $productFactory,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository
    ) {
        $this->productFactory = $productFactory;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function __invoke(CreateProduct $command): void
    {
        $id = new Uuid($command->id());
        $name = new Name($command->name());
        $price = new Price($command->price());
        $image = new Image($command->image());
        $categoryId = new Uuid($command->categoryId());

        $this->guardIdDoesNotExists($id);

        $category = $this->loadCategory($categoryId);
        $product = $this->productFactory->__invoke($id, $name, $price, $image, $category, $command->createdAt());
        $this->productRepository->save($product);
    }

    private function guardIdDoesNotExists(Uuid $id): void
    {
        if ($this->productRepository->byId($id)) {
            throw ProductAlreadyExists::fromId($id);
        }
    }

    private function loadCategory(Uuid $categoryId): Category
    {
        if (!$category = $this->categoryRepository->byId($categoryId)) {
            throw CategoryNotFound::fromId($categoryId);
        }

        return $category;
    }
}
