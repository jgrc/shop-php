<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Amqp;

use DateTimeImmutable;
use InvalidArgumentException;
use Jgrc\Shop\Domain\Common\Bus\Event;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class AmqpMessageSerializer
{
    /** @var string[] */
    private array $mapping;

    public function __construct(array $mapping)
    {
        $this->mapping = $mapping;
    }

    public function serialize(Event $event): string
    {
        return json_encode(
            [
                'type' => $event::name(),
                'id' => $event->id()->value(),
                'when' => $event->when()->format(DATE_ATOM),
                'payload' => $event->payload(),
            ]
        );
    }

    public function deserialize(string $message): Event
    {
        $event = json_decode($message, true);

        if (!$event) {
            throw new InvalidArgumentException(sprintf('Message "%s" is not a valid json', $message));
        }
        if (!array_key_exists('type', $event)) {
            throw new InvalidArgumentException(sprintf('Message "%s" does not contain "type"', $message));
        }
        if (!array_key_exists($event['type'], $this->mapping)) {
            throw new InvalidArgumentException(sprintf('There are not a valid class to map message "%s"', $message));
        }

        return call_user_func(
            [$this->mapping[$event['type']], 'from'],
            new Uuid($event['id']),
            new DateTimeImmutable($event['when']),
            $event['payload']
        );
    }
}
