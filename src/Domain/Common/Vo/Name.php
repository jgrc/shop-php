<?php

namespace Jgrc\Shop\Domain\Common\Vo;

class Name
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(Name $other): bool
    {
        return $this->value === $other->value;
    }
}
