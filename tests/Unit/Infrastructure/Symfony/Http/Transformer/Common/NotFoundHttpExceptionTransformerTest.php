<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Infrastructure\Symfony\Http\Transformer\Common;

use Jgrc\Shop\Infrastructure\Symfony\Http\Transformer\Common\NotFoundHttpExceptionTransformer;
use Jgrc\Shop\Tool\Stub\StringStub;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundHttpExceptionTransformerTest extends TestCase
{
    private NotFoundHttpExceptionTransformer $sut;

    protected function setUp(): void
    {
        $this->sut = new NotFoundHttpExceptionTransformer();
    }

    public function testJsonApiResponseCanBeCreated(): void
    {
        $exception = new NotFoundHttpException(StringStub::sentence());
        $expected = new JsonResponse(
            [
                'errors' => [
                    [
                        'title' => 'Page not found',
                        'code' => 'page-not-found'
                    ]
                ]
            ],
            404
        );

        $this->assertEquals($expected, $this->sut->__invoke($exception));
    }
}
