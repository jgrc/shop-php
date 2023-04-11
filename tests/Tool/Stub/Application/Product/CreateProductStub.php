<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Application\Product;

use DateTimeImmutable;
use Jgrc\Shop\Application\Product\CreateProduct;
use Jgrc\Shop\Tool\Stub\DateTimeImmutableStub;
use Jgrc\Shop\Tool\Stub\IntStub;
use Jgrc\Shop\Tool\Stub\StringStub;
use Jgrc\Shop\Tool\Stub\Stub;

/**
 * @method CreateProduct build()
 * @method static CreateProduct random()
 */
class CreateProductStub
{
    use Stub;

    private string $id;
    private string $name;
    private int $price;
    private string $image;
    private string $categoryId;
    private DateTimeImmutable $createdAt;

    final public function __construct()
    {
        $this->id = StringStub::uuid();
        $this->name = StringStub::word();
        $this->price = IntStub::positive(100000);
        $this->image = StringStub::url();
        $this->categoryId = StringStub::uuid();
        $this->createdAt = DateTimeImmutableStub::random();
    }

    public function withId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function withName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function withPrice(int $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function withImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function withCategoryId(string $categoryId): self
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    public function withCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    protected function instance(): object
    {
        return new CreateProduct(
            $this->id,
            $this->name,
            $this->price,
            $this->image,
            $this->categoryId,
            $this->createdAt
        );
    }
}
