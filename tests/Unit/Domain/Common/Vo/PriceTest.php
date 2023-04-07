<?php

namespace Jgrc\Shop\Unit\Domain\Common\Vo;

use InvalidArgumentException;
use Jgrc\Shop\Domain\Common\Vo\Price;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    /** @dataProvider canBeCreatedFromValidValue */
    public function testCanBeCreatedFromValidValue(int $value): void
    {
        $price = new Price($value);

        $this->assertSame($value, $price->value());
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
        new Price(-1);
    }
}
