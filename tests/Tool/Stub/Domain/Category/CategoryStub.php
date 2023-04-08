<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Domain\Category;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Category\Category;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Tool\Stub\DateTimeImmutableStub;
use Jgrc\Shop\Tool\Stub\Domain\Common\NameStub;
use Jgrc\Shop\Tool\Stub\Domain\Common\UuidStub;
use Jgrc\Shop\Tool\Stub\Stub;

/**
 * @method Category build()
 * @method static Category random()
 */
class CategoryStub
{
    use Stub;

    private Uuid $id;
    private Name $name;
    private DateTimeImmutable $createdAt;

    final public function __construct()
    {
        $this->id = UuidStub::random();
        $this->name = NameStub::random();
        $this->createdAt = DateTimeImmutableStub::random();
    }

    public function withId(Uuid $id): CategoryStub
    {
        $this->id = $id;
        return $this;
    }

    public function withName(Name $name): CategoryStub
    {
        $this->name = $name;
        return $this;
    }

    public function withCreatedAt(DateTimeImmutable $createdAt): CategoryStub
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    protected function instance(): object
    {
        return new Category($this->id, $this->name, $this->createdAt);
    }
}
