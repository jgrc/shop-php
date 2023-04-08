<?php

declare(strict_types=1);

namespace Jgrc\Shop\Application\Category;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Common\Bus\Command;

class CreateCategory implements Command
{
    private string $id;
    private string $name;
    private DateTimeImmutable $createdAt;

    public function __construct(string $id, string $name, DateTimeImmutable $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
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

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
