<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Common\Vo;

use Assert\Assertion;

class Name
{
    private string $value;

    public function __construct(string $value)
    {
        Assertion::notEmpty($value, 'The name can\'t be empty.');
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
