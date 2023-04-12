<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Domain\Product;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Category\View\CategoryProjection;
use Jgrc\Shop\Domain\Filter\View\FilterGroupProjection;
use Jgrc\Shop\Domain\Product\View\ProductProjection;
use Jgrc\Shop\Tool\Stub\BoolStub;
use Jgrc\Shop\Tool\Stub\DateTimeImmutableStub;
use Jgrc\Shop\Tool\Stub\Domain\Category\CategoryProjectionStub;
use Jgrc\Shop\Tool\Stub\Domain\Filter\FilterGroupProjectionStub;
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
    private string $image;
    private CategoryProjection $category;
    private bool $enabled;
    private DateTimeImmutable $createdAt;
    /** @var FilterGroupProjection[] */
    private array $filterGroups;

    public function __construct()
    {
        $this->id = StringStub::uuid();
        $this->name = StringStub::word(3);
        $this->price = IntStub::positive(100000);
        $this->image = StringStub::url();
        $this->category = CategoryProjectionStub::random();
        $this->enabled = BoolStub::random();
        $this->createdAt = DateTimeImmutableStub::random();
        $this->filterGroups = [FilterGroupProjectionStub::random()];
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

    public function withCategory(CategoryProjection $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function withEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;
        return $this;
    }

    public function withCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function withFilterGroups(FilterGroupProjection ...$filterGroups): self
    {
        $this->filterGroups = $filterGroups;
        return $this;
    }

    protected function instance(): object
    {
        return new ProductProjection(
            $this->id,
            $this->name,
            $this->price,
            $this->image,
            $this->category,
            $this->enabled,
            $this->createdAt,
            ...$this->filterGroups
        );
    }
}
