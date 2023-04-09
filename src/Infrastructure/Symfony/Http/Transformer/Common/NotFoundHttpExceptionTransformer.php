<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Symfony\Http\Transformer\Common;

use Jgrc\Shop\Infrastructure\Symfony\Http\JsonApiResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundHttpExceptionTransformer
{
    public function __invoke(NotFoundHttpException $exception): JsonResponse
    {
        return JsonApiResponseBuilder::create()
            ->error(
                title: 'Page not found',
                code: 'page-not-found'
            )
            ->httpStatus(JsonResponse::HTTP_NOT_FOUND)
            ->build();
    }
}
