<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Persistence\Orm\Repository;

use Doctrine\ORM\EntityManager;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Filter\FilterGroup;
use Jgrc\Shop\Domain\Filter\FilterGroupRepository;

class DoctrineFilterGroupRepository implements FilterGroupRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function byId(Uuid $id): ?FilterGroup
    {
        return $this->entityManager->find(FilterGroup::class, $id);
    }

    public function save(FilterGroup $filterGroup): void
    {
        $this->entityManager->persist($filterGroup);
    }
}
