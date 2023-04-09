<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Infrastructure\Symfony\Http\Transformer\Common;

use Assert\InvalidArgumentException;
use Assert\LazyAssertionException;
use Jgrc\Shop\Infrastructure\Symfony\Http\Transformer\Common\LazyAssertionExceptionTransformer;
use Jgrc\Shop\Tool\Stub\IntStub;
use Jgrc\Shop\Tool\Stub\StringStub;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class LazyAssertionExceptionTransformerTest extends TestCase
{
    private LazyAssertionExceptionTransformer $sut;

    protected function setUp(): void
    {
        $this->sut = new LazyAssertionExceptionTransformer();
    }

    public function testJsonApiResponseCanBeCreated(): void
    {
        $childException = new InvalidArgumentException(
            StringStub::sentence(),
            IntStub::positive(),
            StringStub::word()
        );
        $anotherChildException = new InvalidArgumentException(
            StringStub::sentence(),
            IntStub::positive(),
            StringStub::word()
        );
        $exception = new LazyAssertionException(
            StringStub::sentence(),
            [$childException, $anotherChildException]
        );
        $expected = new JsonResponse(
            [
                'errors' => [
                    [
                        'title' => $childException->getMessage(),
                        'code' => 'bad-request',
                        'source' => [
                            'parameter' => $childException->getPropertyPath()
                        ]
                    ],
                    [
                        'title' => $anotherChildException->getMessage(),
                        'code' => 'bad-request',
                        'source' => [
                            'parameter' => $anotherChildException->getPropertyPath()
                        ]
                    ]
                ]
            ],
            400
        );

        $this->assertEquals($expected, $this->sut->__invoke($exception));
    }
}
