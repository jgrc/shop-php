<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Persistence\Es;

use DateTimeImmutable;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Jgrc\Shop\Domain\Category\View\CategoryProjection;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Filter\View\FilterGroupProjection;
use Jgrc\Shop\Domain\Filter\View\FilterProjection;
use Jgrc\Shop\Domain\Product\ProductNotFound;
use Jgrc\Shop\Domain\Product\View\ProductProjection;
use Jgrc\Shop\Domain\Product\View\ProductView;

class ElasticProductView implements ProductView
{
    private Client $client;
    private string $index;

    public function __construct(Client $client, string $index)
    {
        $this->client = $client;
        $this->index = $index;
    }

    public function byId(Uuid $id): ProductProjection
    {
        try {
            /** @var Elasticsearch */
            $response = $this->client->get(['index' => $this->index, 'id' => $id]);
            $product = $response->asArray()['_source'];

            return new ProductProjection(
                $id->value(),
                $product['name'],
                $product['price'],
                $product['image'],
                new CategoryProjection(
                    $product['category']['id'],
                    $product['category']['name']
                ),
                $product['enabled'],
                new DateTimeImmutable($product['created_at']),
                ...array_map(
                    fn(array $filterGroup): FilterGroupProjection => new FilterGroupProjection(
                        $filterGroup['id'],
                        $filterGroup['name'],
                        ...array_map(
                            fn(array $filter): FilterProjection => new FilterProjection(
                                $filter['id'],
                                $filter['name']
                            ),
                            $filterGroup['filters']
                        )
                    ),
                    $product['filter_groups']
                )
            );
        } catch (ClientResponseException $exception) {
            if ($exception->getCode() === 404) {
                throw ProductNotFound::fromId($id);
            }
            throw $exception;
        }
    }
}
