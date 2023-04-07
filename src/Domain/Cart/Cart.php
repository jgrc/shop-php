<?php

namespace Jgrc\Shop\Domain\Cart;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Jgrc\Shop\Domain\Cart\Vo\CartState;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\User\User;

class Cart
{
    private Uuid $id;
    private User $user;
    private CartState $state;
    /** @var Collection<int, CartLine> $lines */
    private Collection $lines;
    private DateTimeImmutable $createdAt;

    public function __construct(Uuid $id, User $user, DateTimeImmutable $createdAt)
    {
        $this->id = $id;
        $this->user = $user;
        $this->createdAt = $createdAt;
        $this->state = CartState::New;
        $this->lines = new ArrayCollection();
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function state(): CartState
    {
        return $this->state;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /** @return  Collection<int, CartLine> */
    public function lines(): Collection
    {
        return $this->lines;
    }
}
