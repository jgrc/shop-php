<?php

declare(strict_types=1);

namespace Jgrc\Shop\Application\Product;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Common\Bus\Command;

class CreateProduct implements Command
{
    private string $id;
    private string $name;
    private int $price;
    private string $image;
    private string $categoryId;
    private DateTimeImmutable $createdAt;

    public function __construct(
        string $id,
        string $name,
        int $price,
        string $image,
        string $categoryId,
        DateTimeImmutable $createdAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->categoryId = $categoryId;
        $this->createdAt = $createdAt;
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

    public function image(): string
    {
        return $this->image;
    }

    public function categoryId(): string
    {
        return $this->categoryId;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
