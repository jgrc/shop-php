<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Domain\Filter;

use Jgrc\Shop\Domain\Filter\View\FilterGroupProjection;
use Jgrc\Shop\Domain\Filter\View\FilterProjection;
use Jgrc\Shop\Tool\Stub\StringStub;
use Jgrc\Shop\Tool\Stub\Stub;

/**
 * @method FilterGroupProjection build()
 * @method static FilterGroupProjection random()
 */
class FilterGroupProjectionStub
{
    use Stub;

    private string $id;
    private string $name;
    /** @var FilterProjection[] */
    private array $filters;

    final public function __construct()
    {
        $this->id = StringStub::uuid();
        $this->name = StringStub::word();
        $this->filters = [FilterProjectionStub::random()];
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

    public function withFilters(FilterProjection ...$filters): self
    {
        $this->filters = $filters;
        return $this;
    }

    protected function instance(): object
    {
        return new FilterGroupProjection($this->id, $this->name, ...$this->filters);
    }
}
