<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Application\Filter;

use DateTimeImmutable;
use Jgrc\Shop\Application\Filter\CreateFilter;
use Jgrc\Shop\Tool\Stub\DateTimeImmutableStub;
use Jgrc\Shop\Tool\Stub\StringStub;
use Jgrc\Shop\Tool\Stub\Stub;

/**
 * @method CreateFilter build()
 * @method static CreateFilter random()
 */
class CreateFilterStub
{
    use Stub;

    private string $id;
    private string $name;
    private string $filterGroupId;
    private DateTimeImmutable $createdAt;

    final public function __construct()
    {
        $this->id = StringStub::uuid();
        $this->name = StringStub::word();
        $this->filterGroupId = StringStub::uuid();
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

    public function withFilterGroupId(string $filterGroupId): self
    {
        $this->filterGroupId = $filterGroupId;
        return $this;
    }

    public function withCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    protected function instance(): object
    {
        return new CreateFilter($this->id, $this->name, $this->filterGroupId, $this->createdAt);
    }
}
