<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Bus;

use Jgrc\Shop\Domain\Common\Bus\Event;
use Jgrc\Shop\Domain\Common\Bus\EventBus;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerEventBus implements EventBus
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function publish(Event ...$events): void
    {
        array_walk($events, fn(Event $event) => $this->bus->dispatch($event));
    }
}
