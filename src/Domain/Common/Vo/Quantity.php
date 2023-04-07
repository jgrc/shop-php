<?php

namespace Jgrc\Shop\Domain\Common\Vo;

use Assert\Assertion;

class Quantity
{
    private int $value;

    public function __construct(int $value)
    {
        Assertion::greaterOrEqualThan($value, 0, 'Quantity "%s" should be greater or equal than "%s".');
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(Quantity $other): bool
    {
        return $this->value === $other->value;
    }
}
