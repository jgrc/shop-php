<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\User;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Common\Vo\Email;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class User
{
    private Uuid $id;
    private Email $email;
    private DateTimeImmutable $createdAt;

    public function __construct(Uuid $id, Email $email, DateTimeImmutable $createdAt)
    {
        $this->id = $id;
        $this->email = $email;
        $this->createdAt = $createdAt;
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
