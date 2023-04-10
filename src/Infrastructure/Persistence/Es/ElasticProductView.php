<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Persistence\Es;

use DateTimeImmutable;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
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
            $document = $response->asArray();

            return new ProductProjection(
                $id->value(),
                $document['_source']['name'],
                $document['_source']['price'],
                new DateTimeImmutable($document['_source']['indexed_at'])
            );
        } catch (ClientResponseException $exception) {
            if ($exception->getCode() === 404) {
                throw ProductNotFound::fromId($id);
            }
            throw $exception;
        }
    }
}
