<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Symfony\Http\Transformer\Common;

use Assert\InvalidArgumentException;
use Jgrc\Shop\Infrastructure\Symfony\Http\JsonApiResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

class InvalidArgumentExceptionTransformer
{
    public function __invoke(InvalidArgumentException $exception): JsonResponse
    {
        return JsonApiResponseBuilder::create()
            ->error(
                title: $exception->getMessage(),
                code: 'bad-request',
                sourceParameter: $exception->getPropertyPath()
            )
            ->httpStatus(JsonResponse::HTTP_BAD_REQUEST)
            ->build();
    }
}
