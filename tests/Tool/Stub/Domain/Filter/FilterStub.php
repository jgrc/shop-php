<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Domain\Filter;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Filter\Filter;
use Jgrc\Shop\Domain\Filter\FilterGroup;
use Jgrc\Shop\Tool\Stub\DateTimeImmutableStub;
use Jgrc\Shop\Tool\Stub\Domain\Common\NameStub;
use Jgrc\Shop\Tool\Stub\Domain\Common\UuidStub;
use Jgrc\Shop\Tool\Stub\Stub;

/**
 * @method Filter build()
 * @method static Filter random()
 */
class FilterStub
{
    use Stub;

    private Uuid $id;
    private Name $name;
    private FilterGroup $filterGroup;
    private DateTimeImmutable $createdAt;

    final public function __construct()
    {
        $this->id = UuidStub::random();
        $this->name = NameStub::random();
        $this->filterGroup = FilterGroupStub::random();
        $this->createdAt = DateTimeImmutableStub::random();
    }

    public function withId(Uuid $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function withName(Name $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function withFilterGroup(FilterGroup $filterGroup): self
    {
        $this->filterGroup = $filterGroup;
        return $this;
    }

    public function withCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    protected function instance(): object
    {
        return new Filter($this->id, $this->name, $this->filterGroup, $this->createdAt);
    }
}
