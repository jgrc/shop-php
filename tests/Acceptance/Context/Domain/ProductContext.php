<?php

declare(strict_types=1);

namespace Jgrc\Shop\Acceptance\Context\Domain;

use Assert\Assert;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use DateTimeImmutable;
use Jgrc\Shop\Application\Product\CreateProduct;
use Jgrc\Shop\Domain\Common\Bus\CommandBus;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Filter\Filter;
use Jgrc\Shop\Domain\Product\Product;
use Jgrc\Shop\Domain\Product\ProductNotFound;
use Jgrc\Shop\Domain\Product\ProductRepository;
use Jgrc\Shop\Tool\Stub\Application\Product\CreateProductStub;

class ProductContext implements Context
{
    private CommandBus $commandBus;
    private ProductRepository $productRepository;

    public function __construct(CommandBus $commandBus, ProductRepository $productRepository)
    {
        $this->commandBus = $commandBus;
        $this->productRepository = $productRepository;
    }

    /** @Given there are the following products: */
    public function thereAreFollowingProducts(TableNode $tableNode): void
    {
        $createProducts = array_map(
            function (array $row) {
                $builder = new CreateProductStub();
                if (array_key_exists('id', $row)) {
                    $builder->withId($row['id']);
                }
                if (array_key_exists('name', $row)) {
                    $builder->withName($row['name']);
                }
                if (array_key_exists('price', $row)) {
                    $builder->withPrice((int) $row['price']);
                }
                if (array_key_exists('image', $row)) {
                    $builder->withImage($row['image']);
                }
                if (array_key_exists('category_id', $row)) {
                    $builder->withCategoryId($row['category_id']);
                }
                if (array_key_exists('created_at', $row)) {
                    $builder->withCreatedAt(new DateTimeImmutable($row['created_at']));
                }
                return $builder->build();
            },
            $tableNode->getHash()
        );
        array_walk($createProducts, fn(CreateProduct $command) => $this->commandBus->dispatch($command));
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
                if (array_key_exists('filter_ids', $row)) {
                    $lazy = $lazy
                        ->that(
                            array_map(
                                fn(string $id): string => trim($id),
                                explode(",", $row['filter_ids'])
                            )
                        )
                        ->eq(
                            array_map(
                                fn(Filter $filter): string => $filter->id()->value(),
                                $product->filters()->toArray()
                            )
                        );
                }
                $lazy->verifyNow();
            },
            $tableNode->getHash()
        );
    }

    private function loadProduct(Uuid $id): Product
    {
        if (!$product = $this->productRepository->byId($id)) {
            throw ProductNotFound::fromId($id);
        }

        return $product;
    }
}
