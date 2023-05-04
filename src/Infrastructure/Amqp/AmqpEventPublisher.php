<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Amqp;

use Jgrc\Shop\Domain\Common\Bus\Event;

class AmqpEventPublisher
{
    private AmqpManager $amqpManager;
    private AmqpMessageSerializer $messageSerializer;
    private string $exchange;

    public function __construct(AmqpManager $amqpManager, AmqpMessageSerializer $messageSerializer, string $exchange)
    {
        $this->amqpManager = $amqpManager;
        $this->messageSerializer = $messageSerializer;
        $this->exchange = $exchange;
    }

    public function __invoke(Event $event): void
    {
        $this
            ->amqpManager
            ->publish(
                $this->messageSerializer->serialize($event),
                $event::name(),
                AMQP_NOPARAM,
                $this->exchange,
                [
                    'content_type'     => 'application/json',
                    'content_encoding' => 'utf-8',
                ]
            );
    }
}
