<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Category;

use Jgrc\Shop\Domain\Common\Exception\AlreadyExists;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class CategoryAlreadyExists extends AlreadyExists
{
    public static function fromId(Uuid $id): self
    {
        return new self(sprintf('Category "%s" already exits.', $id->value()));
    }
}
