<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Persistence\Orm\Repository;

use Doctrine\ORM\EntityManager;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Product\Product;
use Jgrc\Shop\Domain\Product\ProductRepository;

class DoctrineProductRepository implements ProductRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function byId(Uuid $id): ?Product
    {
        return $this->entityManager->find(Product::class, $id);
    }

    public function save(Product $product): void
    {
        $this->entityManager->persist($product);
    }
}
