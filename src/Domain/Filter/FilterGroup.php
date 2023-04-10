<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Filter;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class FilterGroup
{
    private Uuid $id;
    private Name $name;
    /** @var Collection<int, Filter> */
    private Collection $filters;
    private DateTimeImmutable $createdAt;

    public function __construct(Uuid $id, Name $name, DateTimeImmutable $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->filters = new ArrayCollection();
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    /** @return Collection<int, Filter> */
    public function filters(): Collection
    {
        return $this->filters;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function addFilter(Uuid $id, Name $name, DateTimeImmutable $createdAt): self
    {
        $this->filters->add(new Filter($id, $name, $this, $createdAt));
        return $this;
    }
}
