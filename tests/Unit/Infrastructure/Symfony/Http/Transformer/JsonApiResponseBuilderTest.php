<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Infrastructure\Symfony\Http\Transformer;

use Jgrc\Shop\Infrastructure\Symfony\Http\JsonApiResponseBuilder;
use Jgrc\Shop\Tool\Stub\IntStub;
use Jgrc\Shop\Tool\Stub\StringStub;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class JsonApiResponseBuilderTest extends TestCase
{
    public function testDataWithAttributesResponseCanBeCreated(): void
    {
        $type = StringStub::word();
        $id = StringStub::uuid();
        $attributes = [
            'name' => StringStub::word(),
            'number' => IntStub::positive()
        ];
        $status = IntStub::between(2, 5) * 100;
        $sut = JsonApiResponseBuilder::create()
            ->data($type, $id, $attributes)
            ->httpStatus($status);
        $expected = new JsonResponse(
            [
                'data' => [
                    'type' => $type,
                    'id' => $id,
                    'attributes' => $attributes
                ]
            ],
            $status
        );

        $this->assertEquals($expected, $sut->build());
    }

    public function testDataWithoutAttributesResponseCanBeCreated(): void
    {
        $type = StringStub::word();
        $id = StringStub::uuid();
        $status = IntStub::between(2, 5) * 100;
        $sut = JsonApiResponseBuilder::create()
            ->data($type, $id)
            ->httpStatus($status);
        $expected = new JsonResponse(
            [
                'data' => [
                    'type' => $type,
                    'id' => $id,
                ]
            ],
            $status
        );

        $this->assertEquals($expected, $sut->build());
    }

    public function testDataItemsWithAttributesResponseCanBeCreated(): void
    {
        $type = StringStub::word();
        $id = StringStub::uuid();
        $attributes = [
            'name' => StringStub::word(),
            'number' => IntStub::positive()
        ];
        $anotherId = StringStub::uuid();
        $anotherAttributes = [
            'name' => StringStub::word(),
            'number' => IntStub::positive()
        ];
        $status = IntStub::between(2, 5) * 100;
        $sut = JsonApiResponseBuilder::create()
            ->dataItem($type, $id, $attributes)
            ->dataItem($type, $anotherId, $anotherAttributes)
            ->httpStatus($status);
        $expected = new JsonResponse(
            [
                'data' => [
                    [
                        'type' => $type,
                        'id' => $id,
                        'attributes' => $attributes
                    ],
                    [
                        'type' => $type,
                        'id' => $anotherId,
                        'attributes' => $anotherAttributes
                    ]
                ]
            ],
            $status
        );

        $this->assertEquals($expected, $sut->build());
    }

    public function testDataItemsWithoutAttributesResponseCanBeCreated(): void
    {
        $type = StringStub::word();
        $id = StringStub::uuid();
        $anotherId = StringStub::uuid();
        $status = IntStub::between(2, 5) * 100;
        $sut = JsonApiResponseBuilder::create()
            ->dataItem($type, $id)
            ->dataItem($type, $anotherId)
            ->httpStatus($status);
        $expected = new JsonResponse(
            [
                'data' => [
                    [
                        'type' => $type,
                        'id' => $id,
                    ],
                    [
                        'type' => $type,
                        'id' => $anotherId,
                    ]
                ]
            ],
            $status
        );

        $this->assertEquals($expected, $sut->build());
    }

    public function testErrorsBaseCanBeCreated(): void
    {
        $title = StringStub::sentence();
        $code = StringStub::word();
        $anotherTitle = StringStub::sentence();
        $anotherCode = StringStub::word();
        $status = IntStub::between(2, 5) * 100;
        $sut = JsonApiResponseBuilder::create()
            ->error($title, $code)
            ->error($anotherTitle, $anotherCode)
            ->httpStatus($status);
        $expected = new JsonResponse(
            [
                'errors' => [
                    [
                        'title' => $title,
                        'code' => $code,
                    ],
                    [
                        'title' => $anotherTitle,
                        'code' => $anotherCode,
                    ]
                ]
            ],
            $status
        );

        $this->assertEquals($expected, $sut->build());
    }

    public function testErrorsWithAllCanBeCreated(): void
    {
        $title = StringStub::sentence();
        $code = StringStub::word();
        $detail = StringStub::paragraph();
        $sourceParameter = StringStub::word();
        $anotherTitle = StringStub::sentence();
        $anotherCode = StringStub::word();
        $anotherDetail = StringStub::paragraph();
        $anotherSourceParameter = StringStub::word();
        $status = IntStub::between(2, 5) * 100;
        $sut = JsonApiResponseBuilder::create()
            ->error($title, $code, $detail, $sourceParameter)
            ->error($anotherTitle, $anotherCode, $anotherDetail, $anotherSourceParameter)
            ->httpStatus($status);
        $expected = new JsonResponse(
            [
                'errors' => [
                    [
                        'title' => $title,
                        'code' => $code,
                        'detail' => $detail,
                        'source' => [
                            'parameter' => $sourceParameter
                        ]
                    ],
                    [
                        'title' => $anotherTitle,
                        'code' => $anotherCode,
                        'detail' => $anotherDetail,
                        'source' => [
                            'parameter' => $anotherSourceParameter
                        ]
                    ]
                ]
            ],
            $status
        );

        $this->assertEquals($expected, $sut->build());
    }
}
