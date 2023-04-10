<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Filter;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class Filter
{
    private Uuid $id;
    private Name $name;
    private FilterGroup $filterGroup;
    private DateTimeImmutable $createdAt;

    public function __construct(Uuid $id, Name $name, FilterGroup $filterGroup, DateTimeImmutable $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->filterGroup = $filterGroup;
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

    public function filterGroup(): FilterGroup
    {
        return $this->filterGroup;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
