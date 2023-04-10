<?php

declare(strict_types=1);

namespace Jgrc\Shop\Application\Category;

use Jgrc\Shop\Domain\Category\Category;
use Jgrc\Shop\Domain\Category\CategoryAlreadyExists;
use Jgrc\Shop\Domain\Category\CategoryRepository;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class CreateCategoryHandler
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function __invoke(CreateCategory $command): void
    {
        $id = new Uuid($command->id());
        $name = new Name($command->name());

        $this->guardIdDoesNotExists($id);

        $category = new Category($id, $name, $command->createdAt());
        $this->categoryRepository->save($category);
    }

    private function guardIdDoesNotExists(Uuid $id): void
    {
        if ($this->categoryRepository->byId($id)) {
            throw CategoryAlreadyExists::fromId($id);
        }
    }
}
