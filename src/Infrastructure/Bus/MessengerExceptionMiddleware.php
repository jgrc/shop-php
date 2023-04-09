<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Bus;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

class MessengerExceptionMiddleware implements MiddlewareInterface
{
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        try {
            return $stack->next()->handle($envelope, $stack);
        } catch (HandlerFailedException $exception) {
            if ($exception->getPrevious()) {
                throw $exception->getPrevious();
            }
            throw $exception;
        }
    }
}
