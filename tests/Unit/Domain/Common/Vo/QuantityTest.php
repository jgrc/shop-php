<?php

namespace Jgrc\Shop\Unit\Domain\Common\Vo;

use InvalidArgumentException;
use Jgrc\Shop\Domain\Common\Vo\Quantity;
use PHPUnit\Framework\TestCase;

class QuantityTest extends TestCase
{
    /** @dataProvider canBeCreatedFromValidValue */
    public function testCanBeCreatedFromValidValue(int $value): void
    {
        $quantity = new Quantity($value);

        $this->assertSame($value, $quantity->value());
    }

    /** @return int[][] */
    public static function canBeCreatedFromValidValue(): array
    {
        return [
            'zero' => [0],
            'greater than zero value' => [14],
        ];
    }

    public function testCantBeCreatedFromNegative(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Quantity(-1);
    }
}