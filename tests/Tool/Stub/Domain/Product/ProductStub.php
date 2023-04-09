<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Domain\Product;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Category\Category;
use Jgrc\Shop\Domain\Common\Vo\Image;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Price;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Product\Product;
use Jgrc\Shop\Tool\Stub\DateTimeImmutableStub;
use Jgrc\Shop\Tool\Stub\Domain\Category\CategoryStub;
use Jgrc\Shop\Tool\Stub\Domain\Common\ImageStub;
use Jgrc\Shop\Tool\Stub\Domain\Common\NameStub;
use Jgrc\Shop\Tool\Stub\Domain\Common\PriceStub;
use Jgrc\Shop\Tool\Stub\Domain\Common\UuidStub;
use Jgrc\Shop\Tool\Stub\Stub;

/**
 * @method Product build()
 * @method static Product random()
 */
class ProductStub
{
    use Stub;

    private Uuid $id;
    private Name $name;
    private Price $price;
    private Image $image;
    private Category $category;
    private DateTimeImmutable $createdAt;

    final public function __construct()
    {
        $this->id = UuidStub::random();
        $this->name = NameStub::random();
        $this->price = PriceStub::random();
        $this->image = ImageStub::random();
        $this->category = CategoryStub::random();
        $this->createdAt = DateTimeImmutableStub::random();
    }

    public function withId(Uuid $id): ProductStub
    {
        $this->id = $id;
        return $this;
    }

    public function withName(Name $name): ProductStub
    {
        $this->name = $name;
        return $this;
    }

    public function withPrice(Price $price): ProductStub
    {
        $this->price = $price;
        return $this;
    }

    public function withImage(Image $image): ProductStub
    {
        $this->image = $image;
        return $this;
    }

    public function withCategory(Category $category): ProductStub
    {
        $this->category = $category;
        return $this;
    }

    public function withCreatedAt(DateTimeImmutable $createdAt): ProductStub
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    protected function instance(): object
    {
        return new Product(
            $this->id,
            $this->name,
            $this->price,
            $this->image,
            $this->category,
            $this->createdAt
        );
    }
}
