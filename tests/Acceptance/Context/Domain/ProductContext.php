<?php

declare(strict_types=1);

namespace Jgrc\Shop\Acceptance\Context\Domain;

use Assert\Assert;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use DateTimeImmutable;
use Jgrc\Shop\Domain\Category\Category;
use Jgrc\Shop\Domain\Category\CategoryNotFound;
use Jgrc\Shop\Domain\Category\CategoryRepository;
use Jgrc\Shop\Domain\Common\Vo\Image;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Price;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Product\Product;
use Jgrc\Shop\Domain\Product\ProductNotFound;
use Jgrc\Shop\Domain\Product\ProductRepository;
use Jgrc\Shop\Tool\Stub\Domain\Product\ProductStub;

class ProductContext implements Context
{
    private ProductRepository $productRepository;
    private CategoryRepository $categoryRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /** @Given there are the following products: */
    public function thereAreFollowingProducts(TableNode $tableNode): void
    {
        $products = array_map(
            function (array $row) {
                $builder = new ProductStub();
                if (array_key_exists('id', $row)) {
                    $builder->withId(new Uuid($row['id']));
                }
                if (array_key_exists('name', $row)) {
                    $builder->withName(new Name($row['name']));
                }
                if (array_key_exists('price', $row)) {
                    $builder->withPrice(new Price((int) $row['price']));
                }
                if (array_key_exists('image', $row)) {
                    $builder->withImage(new Image($row['image']));
                }
                if (array_key_exists('category_id', $row)) {
                    $category = $this->loadCategory(new Uuid($row['category_id']));
                    $builder->withCategory($category);
                }
                if (array_key_exists('created_at', $row)) {
                    $builder->withCreatedAt(new DateTimeImmutable($row['created_at']));
                }
                return $builder->build();
            },
            $tableNode->getHash()
        );
        array_walk($products, fn(Product $product) => $this->productRepository->save($product));
    }

    /** @Then the following products should exist: */
    public function followingProductsShouldExist(TableNode $tableNode): void
    {
        array_map(
            function (array $row) {
                Assertion::keyExists($row, 'id');
                $lazy = Assert::lazy();
                $product = $this->loadProduct(new Uuid($row['id']));
                if (array_key_exists('name', $row)) {
                    $lazy = $lazy
                        ->that($row['name'])
                        ->eq($product->name()->value(), 'Unexpected name. Expected: "%s", current: "%s"');
                }
                if (array_key_exists('price', $row)) {
                    $lazy = $lazy
                        ->that($row['price'])
                        ->eq($product->price()->value(), 'Unexpected price. Expected: "%s", current: "%s"');
                }
                if (array_key_exists('image', $row)) {
                    $lazy = $lazy
                        ->that($row['image'])
                        ->eq($product->image()->value(), 'Unexpected image. Expected: "%s", current: "%s"');
                }
                if (array_key_exists('category_id', $row)) {
                    $lazy = $lazy
                        ->that($row['category_id'])
                        ->eq(
                            $product->category()->id()->value(),
                            'Unexpected category_id. Expected: "%s", current: "%s"'
                        );
                }
                if (array_key_exists('created_at', $row)) {
                    $lazy = $lazy
                        ->that($row['created_at'])
                        ->eq(
                            $product->createdAt()->format(DATE_ATOM),
                            'Unexpected created_at. Expected: "%s", current: "%s"'
                        );
                }
                $lazy->verifyNow();
            },
            $tableNode->getHash()
        );
    }

    private function loadCategory(Uuid $id): Category
    {
        if (!$category = $this->categoryRepository->byId($id)) {
            throw CategoryNotFound::fromId($id);
        }

        return $category;
    }

    private function loadProduct(Uuid $id): Product
    {
        if (!$product = $this->productRepository->byId($id)) {
            throw ProductNotFound::fromId($id);
        }

        return $product;
    }
}
