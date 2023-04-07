<?php

namespace Jgrc\Shop\Domain\Product;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Category\Category;
use Jgrc\Shop\Domain\Common\Vo\Image;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Price;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class Product
{
    private Uuid $id;
    private Name $name;
    private Price $price;
    private Image $image;
    private Category $category;
    private bool $enabled;
    private DateTimeImmutable $createdAt;

    public function __construct(
        Uuid $id,
        Name $name,
        Price $price,
        Image $image,
        Category $category,
        DateTimeImmutable $createdAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->category = $category;
        $this->createdAt = $createdAt;
        $this->enabled = true;
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function price(): Price
    {
        return $this->price;
    }

    public function image(): Image
    {
        return $this->image;
    }

    public function category(): Category
    {
        return $this->category;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
