<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Domain\Common;

use Jgrc\Shop\Domain\Common\Vo\Price;
use Jgrc\Shop\Tool\Stub\IntStub;

class PriceStub
{
    public static function random(): Price
    {
        return new Price(IntStub::positive(100000));
    }
}
