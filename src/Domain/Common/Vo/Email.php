<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Common\Vo;

use Assert\Assertion;

class Email
{
    private string $value;

    public function __construct(string $value)
    {
        Assertion::email($value, 'The email "%s" is not valid.');
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(Email $other): bool
    {
        return $this->value === $other->value;
    }
}
