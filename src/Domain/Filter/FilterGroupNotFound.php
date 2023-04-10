<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Filter;

use Jgrc\Shop\Domain\Common\Exception\NotFound;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class FilterGroupNotFound extends NotFound
{
    public static function fromId(Uuid $id): self
    {
        return new self(sprintf('Filter Group "%s" not found.', $id));
    }
}
