<?php

namespace Jgrc\Shop\Domain\Cart;

use Jgrc\Shop\Domain\Common\Vo\Uuid;

interface CartRepository
{
    public function byId(Uuid $id): ?Cart;
    public function save(Cart $cart): void;
}