<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Category;

use Jgrc\Shop\Domain\Common\Exception\NotFound;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class CategoryNotFound extends NotFound
{
    public static function fromId(Uuid $id): self
    {
        return new self(sprintf('Category "%s" not found.', $id->value()));
    }
}
