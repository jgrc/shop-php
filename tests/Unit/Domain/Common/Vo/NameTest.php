<?php

namespace Jgrc\Shop\Unit\Domain\Common\Vo;

use InvalidArgumentException;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Tool\Stub\StringStub;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    public function testCanBeCreatedFromValidValue(): void
    {
        $value = StringStub::word();
        $name = new Name($value);

        $this->assertSame($value, $name->value());
    }

    public function testCantBeCreatedFromEmptyValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Name('');
    }
}
