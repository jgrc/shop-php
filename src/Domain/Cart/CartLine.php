<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Cart;

use DateTimeImmutable;
use Jgrc\Shop\Domain\Common\Vo\Quantity;
use Jgrc\Shop\Domain\Product\Product;

class CartLine
{
    private Cart $cart;
    private Product $product;
    private Quantity $quantity;
    private DateTimeImmutable $createdAt;

    public function __construct(Cart $cart, Product $product, Quantity $quantity, DateTimeImmutable $createdAt)
    {
        $this->cart = $cart;
        $this->product = $product;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
    }

    public function cart(): Cart
    {
        return $this->cart;
    }

    public function product(): Product
    {
        return $this->product;
    }

    public function quantity(): Quantity
    {
        return $this->quantity;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
