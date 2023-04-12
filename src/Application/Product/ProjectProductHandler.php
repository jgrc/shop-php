<?php

declare(strict_types=1);

namespace Jgrc\Shop\Application\Product;

use Jgrc\Shop\Domain\Common\Service\Clock;
use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Product\View\ProductProjector;
use Jgrc\Shop\Domain\Product\View\ProductStore;

class ProjectProductHandler
{
    private ProductProjector $productProjector;
    private ProductStore $productStore;
    private Clock $clock;

    public function __construct(ProductProjector $productProjector, ProductStore $productStore, Clock $clock)
    {
        $this->productProjector = $productProjector;
        $this->productStore = $productStore;
        $this->clock = $clock;
    }

    public function __invoke(ProjectProduct $command): void
    {
        $id = new Uuid($command->id());
        $productProjection = $this->productProjector->create($id);
        $this->productStore->save($productProjection, $this->clock->now());
    }
}
