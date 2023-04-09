<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Symfony\Http\Transformer\Common;

use Assert\LazyAssertionException;
use InvalidArgumentException;
use Jgrc\Shop\Infrastructure\Symfony\Http\JsonApiResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

class LazyAssertionExceptionTransformer
{
    public function __invoke(LazyAssertionException $exception): JsonResponse
    {
        $builder = JsonApiResponseBuilder::create();

        array_map(
            fn(InvalidArgumentException $exception) => $builder->error(
                title: $exception->getMessage(),
                code: 'bad-request',
                sourceParameter: $exception->getPropertyPath()
            ),
            $exception->getErrorExceptions()
        );

        return $builder
            ->httpStatus(JsonResponse::HTTP_BAD_REQUEST)
            ->build();
    }
}
