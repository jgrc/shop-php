<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Infrastructure\Symfony\Http\Transformer\Common;

use Assert\InvalidArgumentException;
use Jgrc\Shop\Infrastructure\Symfony\Http\Transformer\Common\InvalidArgumentExceptionTransformer;
use Jgrc\Shop\Tool\Stub\IntStub;
use Jgrc\Shop\Tool\Stub\StringStub;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class InvalidArgumentExceptionTransformerTest extends TestCase
{
    private InvalidArgumentExceptionTransformer $sut;

    protected function setUp(): void
    {
        $this->sut = new InvalidArgumentExceptionTransformer();
    }

    public function testJsonApiResponseCanBeCreated(): void
    {
        $exception = new InvalidArgumentException(
            StringStub::sentence(),
            IntStub::positive(),
            StringStub::word()
        );
        $expected = new JsonResponse(
            [
                'errors' => [
                    [
                        'title' => $exception->getMessage(),
                        'code' => 'bad-request',
                        'source' => [
                            'parameter' => $exception->getPropertyPath()
                        ]
                    ]
                ]
            ],
            400
        );

        $this->assertEquals($expected, $this->sut->__invoke($exception));
    }
}
