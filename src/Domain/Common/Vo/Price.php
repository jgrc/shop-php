<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Common\Vo;

use Assert\Assertion;

class Price
{
    private int $value;

    public function __construct(int $value)
    {
        Assertion::greaterOrEqualThan($value, 0, 'Price "%s" should be greater or equal than "%s".');
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(Price $other): bool
    {
        return $this->value === $other->value;
    }
}
