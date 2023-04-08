<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Domain\Common\Vo;

use InvalidArgumentException;
use Jgrc\Shop\Domain\Common\Vo\Price;
use Jgrc\Shop\Tool\Stub\IntStub;
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
            'greater than zero value' => [IntStub::positive()],
        ];
    }

    public function testCantBeCreatedFromNegative(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Price(IntStub::negative());
    }
}
