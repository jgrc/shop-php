<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Persistence\Dbal\Projector;

use DateTimeImmutable;
use Doctrine\DBAL\Connection;
use Jgrc\Shop\Domain\Category\View\CategoryProjection;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Filter\View\FilterGroupProjection;
use Jgrc\Shop\Domain\Filter\View\FilterProjection;
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

    public function create(Uuid $id): ProductProjection
    {
        /** @var string[] */
        $product = $this
            ->connection
            ->createQueryBuilder()
            ->select(
                'p.name',
                'p.price',
                'p.image',
                'p.enabled',
                'p.created_at',
                'c.id as cat_id',
                'c.name as cat_name',
            )
            ->from('products', 'p')
            ->innerJoin('p', 'categories', 'c', 'p.category_id = c.id')
            ->where('p.id = :id')
            ->setParameter('id', $id->value())
            ->fetchAssociative();

        if (!$product) {
            throw ProductNotFound::fromId($id);
        }

        return new ProductProjection(
            $id->value(),
            $product['name'],
            (int) $product['price'],
            $product['image'],
            new CategoryProjection(
                $product['cat_id'],
                $product['cat_name']
            ),
            (bool) $product['enabled'],
            new DateTimeImmutable($product['created_at']),
            ...$this->loadFilterGroups($id)
        );
    }

    /** @return FilterGroupProjection[] */
    private function loadFilterGroups(Uuid $productId): array
    {
        $filters = $this
            ->connection
            ->createQueryBuilder()
            ->select(
                'f.id',
                'f.name',
                'g.id as group_id',
                'g.name as group_name'
            )
            ->from('products_filters', 'pf')
            ->innerJoin('pf', 'filters', 'f', 'pf.filter_id = f.id')
            ->innerJoin('f', 'filter_groups', 'g', 'f.filter_group_id = g.id')
            ->where('pf.product_id = :id')
            ->orderBy('g.id', 'ASC')
            ->addOrderBy('f.id', 'ASC')
            ->setParameter('id', $productId->value())
            ->fetchAllAssociative();

        $filterGroups = array_values(
            array_reduce(
                $filters,
                function (array $carry, array $row) {
                    /** @var string */
                    $groupId = $row['group_id'];
                    $filter = ['id' => $row['id'], 'name' => $row['name']];
                    if (array_key_exists($groupId, $carry)) {
                        $carry[$groupId]['filters'][] = $filter;
                    } else {
                        $carry[$groupId] = [
                            'id' => $groupId,
                            'name' => $row['group_name'],
                            'filters' => [$filter]
                        ];
                    }
                    return $carry;
                },
                []
            )
        );

        return array_map(
            fn(array $groupRow): FilterGroupProjection => new FilterGroupProjection(
                $groupRow['id'],
                $groupRow['name'],
                ...array_map(
                    fn(array $filterRow): FilterProjection => new FilterProjection(
                        $filterRow['id'],
                        $filterRow['name']
                    ),
                    $groupRow['filters']
                )
            ),
            $filterGroups
        );
    }
}
