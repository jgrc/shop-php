<?php

namespace Jgrc\Shop\Domain\Category;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class Category
{
    private Uuid $id;
    private Name $name;
    private DateTimeImmutable $createdAt;

    public function __construct(Uuid $id, Name $name, DateTimeImmutable $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = $createdAt;
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}