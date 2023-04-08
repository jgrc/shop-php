<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Domain\Common;

use Jgrc\Shop\Domain\Common\Vo\Name;
use Jgrc\Shop\Tool\Stub\IntStub;
use Jgrc\Shop\Tool\Stub\StringStub;

class NameStub
{
    public static function random(): Name
    {
        return new Name(StringStub::word(IntStub::between(1, 3)));
    }
}
