<?php

declare(strict_types=1);

namespace Jgrc\Shop\Application\Filter;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Common\Bus\Command;

class CreateFilter implements Command
{
    private string $id;
    private string $name;
    private string $filterGroupId;
    private DateTimeImmutable $createdAt;

    public function __construct(string $id, string $name, string $filterGroupId, DateTimeImmutable $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->filterGroupId = $filterGroupId;
        $this->createdAt = $createdAt;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function filterGroupId(): string
    {
        return $this->filterGroupId;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
