<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Product\View;

use DateTimeImmutable;

class ProductProjection
{
    private string $id;
    private string $name;
    private int $price;
    private DateTimeImmutable $indexedAt;

    public function __construct(string $id, string $name, int $price, DateTimeImmutable $indexedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->indexedAt = $indexedAt;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function price(): int
    {
        return $this->price;
    }

    public function indexedAt(): DateTimeImmutable
    {
        return $this->indexedAt;
    }
}
