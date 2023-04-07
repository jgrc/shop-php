<?php

namespace Jgrc\Shop\Unit\Domain\Common\Vo;

use InvalidArgumentException;
use Jgrc\Shop\Domain\Common\Vo\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testCanBeCreatedFromValidValue(): void
    {
        $value = 'valid@email.com';
        $email = new Email($value);

        $this->assertSame($value, $email->value());
    }

    /** @dataProvider cantBeCreatedFromInvalidValue */
    public function testCantBeCreatedFromInvalidValue(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Email($value);
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
