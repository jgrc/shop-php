<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Ui\Http\Product;

use Jgrc\Shop\Application\Product\GetProductById;
use Jgrc\Shop\Domain\Common\Bus\QueryBus;

class GetProductByIdController
{
    private QueryBus $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(string $id): object
    {
        return $this->queryBus->query(new GetProductById($id));
    }
}
