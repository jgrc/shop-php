<?php

namespace Jgrc\Shop\Domain\Common\Vo;

class Uuid
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

    public function equals(Uuid $other): bool {
        return $this->value === $other->value;
    }
}