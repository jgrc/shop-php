<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub\Application\Product;

use Jgrc\Shop\Application\Product\AddProductFilters;
use Jgrc\Shop\Tool\Stub\StringStub;
use Jgrc\Shop\Tool\Stub\Stub;

/**
 * @method AddProductFilters build()
 * @method static AddProductFilters random()
 */
class AddProductFiltersStub
{
    use Stub;

    private string $productId;
    /** @var string[] */
    private array $filterIds;

    final public function __construct()
    {
        $this->productId = StringStub::uuid();
        $this->filterIds = [StringStub::uuid(), StringStub::uuid()];
    }

    public function withProductId(string $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

    public function withFilterIds(string ...$filterIds): self
    {
        $this->filterIds = $filterIds;
        return $this;
    }

    protected function instance(): object
    {
        return new AddProductFilters($this->productId, ...$this->filterIds);
    }
}
