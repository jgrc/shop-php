<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Application\Category;

use DateTimeImmutable;
use Jgrc\Shop\Application\Category\CreateCategory;
use Jgrc\Shop\Tool\Stub\DateTimeImmutableStub;
use Jgrc\Shop\Tool\Stub\StringStub;
use Jgrc\Shop\Tool\Stub\Stub;

/**
 * @method CreateCategory build()
 * @method static CreateCategory random()
 */
class CreateCategoryStub
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

    public function withId(string $id): CreateCategoryStub
    {
        $this->id = $id;
        return $this;
    }

    public function withName(string $name): CreateCategoryStub
    {
        $this->name = $name;
        return $this;
    }

    public function withCreatedAt(DateTimeImmutable $createdAt): CreateCategoryStub
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    protected function instance(): CreateCategory
    {
        return new CreateCategory($this->id, $this->name, $this->createdAt);
    }
}
