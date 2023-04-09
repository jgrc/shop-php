<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Product;

use Jgrc\Shop\Domain\Common\Exception\AlreadyExists;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class ProductAlreadyExists extends AlreadyExists
{
    public static function fromId(Uuid $id): self
    {
        return new self(sprintf('Product "%s" already exits.', $id->value()));
    }
}
