<?php

declare(strict_types=1);

namespace Jgrc\Shop\Acceptance\Context\Domain;

use Assert\Assert;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use DateTimeImmutable;
use Jgrc\Shop\Application\Category\CreateCategory;
use Jgrc\Shop\Domain\Category\Category;
use Jgrc\Shop\Domain\Category\CategoryNotFound;
use Jgrc\Shop\Domain\Category\CategoryRepository;
use Jgrc\Shop\Domain\Common\Bus\CommandBus;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Tool\Stub\Application\Category\CreateCategoryStub;

class CategoryContext implements Context
{
    private CommandBus $commandBus;
    private CategoryRepository $categoryRepository;

    public function __construct(CommandBus $commandBus, CategoryRepository $categoryRepository)
    {
        $this->commandBus = $commandBus;
        $this->categoryRepository = $categoryRepository;
    }

    /** @Given there are the following categories: */
    public function thereAreFollowingCategories(TableNode $tableNode): void
    {
        $createCategories = array_map(
            function (array $row) {
                $builder = new CreateCategoryStub();
                if (array_key_exists('id', $row)) {
                    $builder->withId($row['id']);
                }
                if (array_key_exists('name', $row)) {
                    $builder->withName($row['name']);
                }
                if (array_key_exists('created_at', $row)) {
                    $builder->withCreatedAt(new DateTimeImmutable($row['created_at']));
                }
                return $builder->build();
            },
            $tableNode->getHash()
        );
        array_walk($createCategories, fn(CreateCategory $command) => $this->commandBus->dispatch($command));
    }

    /** @Then the following categories should exist: */
    public function followingCategoriesShouldExist(TableNode $tableNode): void
    {
        array_map(
            function (array $row) {
                Assertion::keyExists($row, 'id');
                $lazy = Assert::lazy();
                $category = $this->loadCategory(new Uuid($row['id']));
                if (array_key_exists('name', $row)) {
                    $lazy = $lazy
                        ->that($row['name'])
                        ->eq($category->name()->value(), 'Unexpected name. Expected: "%s", current: "%s"');
                }
                if (array_key_exists('created_at', $row)) {
                    $lazy = $lazy
                        ->that($row['created_at'])
                        ->eq(
                            $category->createdAt()->format(DATE_ATOM),
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
}
