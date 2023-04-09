<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Bus;

use Jgrc\Shop\Domain\Common\Bus\Query;
use Jgrc\Shop\Domain\Common\Bus\QueryBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class MessengerQueryBus implements QueryBus
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function query(Query $query): object
    {
        /** @var HandledStamp $handledStamp */
        $handledStamp = $this->bus->dispatch($query)->last(HandledStamp::class);
        /** @var object $result */
        $result = $handledStamp->getResult();
        return $result;
    }
}
