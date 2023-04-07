<?php

namespace Jgrc\Shop\Domain\Common\Vo;

use Assert\Assertion;

class Uuid
{
    private string $value;

    public function __construct(string $value)
    {
        Assertion::uuid($value, 'Id "%s" is not a valid UUID.');
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(Uuid $other): bool
    {
        return $this->value === $other->value;
    }
}
