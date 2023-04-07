<?php

namespace Jgrc\Shop\Unit\Domain\Common\Vo;

use InvalidArgumentException;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Tool\Stub\StringStub;
use PHPUnit\Framework\TestCase;

class UuidTest extends TestCase
{
    public function testCanBeCreatedFromValidValue(): void
    {
        $value = StringStub::uuid();
        $name = new Uuid($value);

        $this->assertSame($value, $name->value());
    }

    /** @dataProvider cantBeCreatedFromInvalidValue */
    public function testCantBeCreatedFromInvalidValue(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Uuid($value);
    }

    /** @return string[][] */
    public static function cantBeCreatedFromInvalidValue(): array
    {
        return [
            'invalid value' => ['invalid-value'],
            'empty value' => [''],
        ];
    }
}
