<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Persistence\Orm\Repository;

use Doctrine\ORM\EntityManager;
use Jgrc\Shop\Domain\Category\Category;
use Jgrc\Shop\Domain\Category\CategoryRepository;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class DoctrineCategoryRepository implements CategoryRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function byId(Uuid $id): ?Category
    {
        return $this->entityManager->find(Category::class, $id);
    }

    public function save(Category $category): void
    {
        $this->entityManager->persist($category);
    }
}
