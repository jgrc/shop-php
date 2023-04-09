<?php

declare(strict_types=1);

namespace Jgrc\Shop\Unit\Domain\Common\Vo;

use InvalidArgumentException;
use Jgrc\Shop\Domain\Common\Vo\Price;
use Jgrc\Shop\Tool\Stub\IntStub;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    public function testCanBeCreatedFromValidValue(): void
    {
        $value = IntStub::positive();
        $price = new Price($value);

        $this->assertSame($value, $price->value());
    }

    /** @dataProvider cantBeCreatedFromZeroOrNegative */
    public function testCantBeCreatedFromZeroOrNegative(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Price($value);
    }

    /** @return int[][] */
    public static function cantBeCreatedFromZeroOrNegative(): array
    {
        return [
            'zero' => [0],
            'negative' => [IntStub::negative()],
        ];
    }
}
