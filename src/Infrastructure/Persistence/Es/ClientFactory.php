<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Persistence\Es;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;

class ClientFactory
{
    public static function create(string $hosts): Client
    {
        return ClientBuilder::create()
            ->setHosts(explode(',', $hosts))
            ->build();
    }
}
