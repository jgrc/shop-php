<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Product;

use Jgrc\Shop\Domain\Common\Exception\NotFound;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class ProductNotFound extends NotFound
{
    public static function fromId(Uuid $id): self
    {
        return new self(sprintf('Product "%s" not found.', $id->value()));
    }
}
