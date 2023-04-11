<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Application\Filter;

use DateTimeImmutable;
use Jgrc\Shop\Application\Filter\CreateFilterGroup;
use Jgrc\Shop\Tool\Stub\DateTimeImmutableStub;
use Jgrc\Shop\Tool\Stub\StringStub;
use Jgrc\Shop\Tool\Stub\Stub;

/**
 * @method CreateFilterGroup build()
 * @method static CreateFilterGroup random()
 */
class CreateFilterGroupStub
{
    use Stub;

    private string $id;
    private string $name;
    private DateTimeImmutable $createdAt;

    final public function __construct()
    {
        $this->id = StringStub::uuid();
        $this->name = StringStub::word();
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

    public function withCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    protected function instance(): object
    {
        return new CreateFilterGroup($this->id, $this->name, $this->createdAt);
    }
}
