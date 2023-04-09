<?php

declare(strict_types=1);

namespace Jgrc\Shop\Acceptance\Context\Infrastructure;

use Behat\Behat\Context\Context;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\ClientResponseException;

class ElasticContext implements Context
{
    private Client $client;
    private string $index;

    public function __construct(Client $client, string $index)
    {
        $this->client = $client;
        $this->index = $index;
    }

    /** @BeforeScenario */
    public function prepareDatabase(): void
    {
        $params = ['index' => $this->index];
        try {
            $this->client->indices()->delete($params);
        } catch (ClientResponseException $exception) {
            if ($exception->getCode() !== 404) {
                throw $exception;
            }
        }
    }
}
