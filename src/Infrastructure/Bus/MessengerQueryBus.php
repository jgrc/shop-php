<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Bus;

use Jgrc\Shop\Domain\Common\Bus\Query;
use Jgrc\Shop\Domain\Common\Bus\QueryBus;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerQueryBus implements QueryBus
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function query(Query $query): object
    {
        return $this->bus->dispatch($query)->getMessage();
    }
}
