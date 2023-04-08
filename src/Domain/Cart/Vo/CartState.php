<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Cart\Vo;

enum CartState: int
{
    case New = 0;
    case Finished = 1;
    case Cancelled = 2;
}
