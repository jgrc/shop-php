<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Common\Vo;

use Assert\Assertion;
use Stringable;

class Uuid implements Stringable
{
    private string $value;

    public function __construct(string $value)
    {
        Assertion::uuid($value, 'Id "%s" is not a valid UUID.', 'id');
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

    public function __toString(): string
    {
        return $this->value();
    }
}
