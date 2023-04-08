<?php

declare(strict_types=1);

namespace Jgrc\Shop\Application\Category;

use Jgrc\Shop\Domain\Category\CategoryRepository;
use Jgrc\Shop\Domain\Category\Service\CategoryFactory;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class CreateCategoryHandler
{
    private CategoryFactory $categoryFactory;
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryFactory $categoryFactory, CategoryRepository $categoryRepository)
    {
        $this->categoryFactory = $categoryFactory;
        $this->categoryRepository = $categoryRepository;
    }

    public function __invoke(CreateCategory $command): void
    {
        $category = $this->categoryFactory->__invoke(
            new Uuid($command->id()),
            new Name($command->name()),
            $command->createdAt()
        );
        $this->categoryRepository->save($category);
    }
}
