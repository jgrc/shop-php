<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Domain\Product;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Product\View\ProductProjection;
use Jgrc\Shop\Tool\Stub\DateTimeImmutableStub;
use Jgrc\Shop\Tool\Stub\IntStub;
use Jgrc\Shop\Tool\Stub\StringStub;
use Jgrc\Shop\Tool\Stub\Stub;

/**
 * @method ProductProjection build()
 * @method static ProductProjection random()
 */
class ProductProjectionStub
{
    use Stub;

    private string $id;
    private string $name;
    private int $price;
    private DateTimeImmutable $indexedAt;

    final public function __construct()
    {
        $this->id = StringStub::uuid();
        $this->name = StringStub::word();
        $this->price = IntStub::positive();
        $this->indexedAt = DateTimeImmutableStub::random();
    }

    public function withId(string $id): ProductProjectionStub
    {
        $this->id = $id;
        return $this;
    }

    public function withName(string $name): ProductProjectionStub
    {
        $this->name = $name;
        return $this;
    }

    public function withPrice(int $price): ProductProjectionStub
    {
        $this->price = $price;
        return $this;
    }

    public function withIndexedAt(DateTimeImmutable $indexedAt): ProductProjectionStub
    {
        $this->indexedAt = $indexedAt;
        return $this;
    }

    protected function instance(): object
    {
        return new ProductProjection(
            $this->id,
            $this->name,
            $this->price,
            $this->indexedAt
        );
    }
}
