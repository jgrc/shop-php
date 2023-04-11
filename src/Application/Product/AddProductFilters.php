<?php

declare(strict_types=1);

namespace Jgrc\Shop\Application\Product;

use Jgrc\Shop\Domain\Common\Bus\Command;

class AddProductFilters implements Command
{
    private string $productId;
    /** @var string[] */
    private array $filterIds;

    public function __construct(string $productId, string ...$filterIds)
    {
        $this->productId = $productId;
        $this->filterIds = $filterIds;
    }

    public function productId(): string
    {
        return $this->productId;
    }

    /** @return string[] */
    public function filterIds(): array
    {
        return $this->filterIds;
    }
}
