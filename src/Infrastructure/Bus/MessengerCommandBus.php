<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Bus;

use Jgrc\Shop\Domain\Common\Bus\Command;
use Jgrc\Shop\Domain\Common\Bus\CommandBus;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerCommandBus implements CommandBus
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function dispatch(Command $command): void
    {
        $this->bus->dispatch($command);
    }
}
