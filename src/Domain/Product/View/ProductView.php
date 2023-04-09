<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Product\View;

use Jgrc\Shop\Domain\Common\Vo\Uuid;

interface ProductView
{
    public function byId(Uuid $id): ProductProjection;
}
