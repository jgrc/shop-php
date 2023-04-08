<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Domain\Common;

use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Tool\Stub\StringStub;

class UuidStub
{
    public static function random(): Uuid
    {
        return new Uuid(StringStub::uuid());
    }
}
