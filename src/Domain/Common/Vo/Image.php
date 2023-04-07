<?php

namespace Jgrc\Shop\Domain\Common\Vo;

use Assert\Assertion;

class Image
{
    private string $value;

    public function __construct(string $value)
    {
        Assertion::url($value, 'The image "%s" is not a valid url.');
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(Image $other): bool
    {
        return $this->value === $other->value;
    }
}
