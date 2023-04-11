<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Persistence\Orm\Repository;

use Doctrine\ORM\EntityManager;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Filter\Filter;
use Jgrc\Shop\Domain\Filter\FilterRepository;

class DoctrineFilterRepository implements FilterRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function byId(Uuid $id): ?Filter
    {
        return $this->entityManager->find(Filter::class, $id);
    }

    public function save(Filter $filterGroup): void
    {
        $this->entityManager->persist($filterGroup);
    }
}
