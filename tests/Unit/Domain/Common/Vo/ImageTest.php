<?php

namespace Jgrc\Shop\Unit\Domain\Common\Vo;

use InvalidArgumentException;
use Jgrc\Shop\Domain\Common\Vo\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testCanBeCreatedFromValidValue(): void
    {
        $value = 'https://www.domain-com/image.jpg';
        $image = new Image($value);

        $this->assertSame($value, $image->value());
    }

    /** @dataProvider cantBeCreatedFromInvalidValue */
    public function testCantBeCreatedFromInvalidValue(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Image($value);
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
