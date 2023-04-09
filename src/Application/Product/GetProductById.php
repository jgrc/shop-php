<?php

declare(strict_types=1);

namespace Jgrc\Shop\Application\Product;

use Jgrc\Shop\Domain\Common\Bus\Query;

class GetProductById implements Query
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
