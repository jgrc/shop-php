<?php

declare(strict_types=1);

namespace Jgrc\Shop\Domain\Product\View;

use Jgrc\Shop\Domain\Common\Vo\Uuid;

interface ProductProjector
{
    public function create(Uuid $id): ProductProjection;
}
