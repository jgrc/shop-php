<?php

namespace Jgrc\Shop\Domain\Common\Vo;

class Quantity
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(Quantity $other): bool {
        return $this->value === $other->value;
    }
}