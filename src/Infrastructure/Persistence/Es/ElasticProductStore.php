<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Persistence\Es;

use DateTimeImmutable;
use Elastic\Elasticsearch\Client;
use Jgrc\Shop\Domain\Filter\View\FilterGroupProjection;
use Jgrc\Shop\Domain\Filter\View\FilterProjection;
use Jgrc\Shop\Domain\Product\View\ProductProjection;
use Jgrc\Shop\Domain\Product\View\ProductStore;

class ElasticProductStore implements ProductStore
{
    private Client $client;
    private string $index;

    public function __construct(Client $client, string $index)
    {
        $this->client = $client;
        $this->index = $index;
    }

    public function createIndex(): void
    {
    }

    public function save(ProductProjection $product, DateTimeImmutable $when): void
    {
        $document = [
            'index' => $this->index,
            'id'    => $product->id(),
            'body'  => [
                'name' => $product->name(),
                'price' => $product->price(),
                'image' => $product->image(),
                'enabled' => $product->enabled(),
                'created_at' => $product->createdAt()->format(DATE_ATOM),
                'indexed_at' => $when->format(DATE_ATOM),
                'category' => [
                    'id' => $product->category()->id(),
                    'name' => $product->category()->name(),
                ],
                'filter_groups' => array_map(
                    fn(FilterGroupProjection $filterGroup): array => [
                        'id' => $filterGroup->id(),
                        'name' => $filterGroup->name(),
                        'filters' => array_map(
                            fn(FilterProjection $filter): array => [
                                'id' => $filter->id(),
                                'name' => $filter->name()
                            ],
                            $filterGroup->filters()
                        )
                    ],
                    $product->filterGroups()
                )
            ]
        ];

        $this->client->index($document);
    }
}
