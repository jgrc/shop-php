<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Filter\View;

class FilterGroupProjection
{
    private string $id;
    private string $name;
    /** @var FilterProjection[] */
    private array $filters;

    public function __construct(string $id, string $name, FilterProjection ...$filters)
    {
        $this->id = $id;
        $this->name = $name;
        $this->filters = $filters;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    /** @return FilterProjection[] */
    public function filters(): array
    {
        return $this->filters;
    }
}
