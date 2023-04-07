<?php

namespace Jgrc\Shop\Domain\Common\Vo;

class Image
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

    public function equals(Image $other): bool
    {
        return $this->value === $other->value;
    }
}
