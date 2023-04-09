<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Persistence\Es;

use Elastic\Elasticsearch\Client;
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

    public function save(ProductProjection $product): void
    {
        $document = [
            'index' => $this->index,
            'id'    => $product->id(),
            'body'  => [
                'name' => $product->name(),
                'price' => $product->price(),
                'indexed_at' => $product->indexedAt()->format(DATE_ATOM),
            ]
        ];

        $this->client->index($document);
    }
}
