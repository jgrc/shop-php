<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Symfony\Listener;

use Jgrc\Shop\Infrastructure\Symfony\Http\JsonApiResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Throwable;

class KernelExceptionListener
{
    private MessageBusInterface $transformerBus;

    public function __construct(MessageBusInterface $transformerBus)
    {
        $this->transformerBus = $transformerBus;
    }

    public function __invoke(ExceptionEvent $event): void
    {
        $event->setResponse($this->transform($event->getThrowable()));
    }

    private function transform(Throwable $throwable): JsonResponse
    {
        try {
            /** @var HandledStamp */
            $handledStamp = $this->transformerBus->dispatch($throwable)->last(HandledStamp::class);
            /** @var JsonResponse */
            $result = $handledStamp->getResult();
            return $result;
        } catch (NoHandlerForMessageException $exception) {
            return JsonApiResponseBuilder::create()
                ->error(
                    title: 'Unexpected server error',
                    code: 'unexpected-error',
                    detail: sprintf('%s. %s', get_class($exception), $exception->getMessage())
                )
                ->httpStatus(JsonResponse::HTTP_INTERNAL_SERVER_ERROR)
                ->build();
        }
    }
}
