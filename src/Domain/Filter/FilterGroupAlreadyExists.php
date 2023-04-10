<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Filter;

use Jgrc\Shop\Domain\Common\Exception\AlreadyExists;
use Jgrc\Shop\Domain\Common\Vo\Uuid;

class FilterGroupAlreadyExists extends AlreadyExists
{
    public static function fromId(Uuid $id): self
    {
        return new self(sprintf('Filter Group "%s" already exits.', $id));
    }
}
