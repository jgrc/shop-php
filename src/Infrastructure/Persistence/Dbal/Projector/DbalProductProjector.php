<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Persistence\Dbal\Projector;

use DateTimeImmutable;
use Doctrine\DBAL\Connection;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Product\ProductNotFound;
use Jgrc\Shop\Domain\Product\View\ProductProjection;
use Jgrc\Shop\Domain\Product\View\ProductProjector;

class DbalProductProjector implements ProductProjector
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function create(Uuid $id, DateTimeImmutable $when): ProductProjection
    {
        /** @var string[] */
        $product = $this
            ->connection
            ->createQueryBuilder()
            ->select(
                'name',
                'price'
            )
            ->from('products', 'p')
            ->where('id = :id')
            ->setParameter('id', $id->value())
            ->fetchAssociative();

        if (!$product) {
            throw ProductNotFound::fromId($id);
        }

        return new ProductProjection(
            $id->value(),
            $product['name'],
            (int) $product['price'],
            $when
        );
    }
}
