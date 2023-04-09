<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Symfony\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class KernelViewListener
{
    private MessageBusInterface $transformerBus;

    public function __construct(MessageBusInterface $transformerBus)
    {
        $this->transformerBus = $transformerBus;
    }

    public function __invoke(ViewEvent $event): void
    {
        /** @var object $response */
        $response = $event->getControllerResult();
        $event->setResponse($this->transform($response));
    }

    private function transform(object $response): JsonResponse
    {
        /** @var HandledStamp $handledStamp */
        $handledStamp = $this->transformerBus->dispatch($response)->last(HandledStamp::class);
        /** @var JsonResponse $result */
        $result = $handledStamp->getResult();
        return $result;
    }
}
