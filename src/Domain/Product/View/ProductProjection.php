<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Product\View;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Category\View\CategoryProjection;
use Jgrc\Shop\Domain\Filter\View\FilterGroupProjection;

class ProductProjection
{
    private string $id;
    private string $name;
    private int $price;
    private string $image;
    private CategoryProjection $category;
    private bool $enabled;
    private DateTimeImmutable $createdAt;
    /** @var FilterGroupProjection[] */
    private array $filterGroups;

    public function __construct(
        string $id,
        string $name,
        int $price,
        string $image,
        CategoryProjection $category,
        bool $enabled,
        DateTimeImmutable $createdAt,
        FilterGroupProjection ...$filterGroups
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->category = $category;
        $this->enabled = $enabled;
        $this->createdAt = $createdAt;
        $this->filterGroups = $filterGroups;
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

    public function category(): CategoryProjection
    {
        return $this->category;
    }

    public function enabled(): bool
    {
        return $this->enabled;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /** @return FilterGroupProjection[] */
    public function filterGroups(): array
    {
        return $this->filterGroups;
    }
}
