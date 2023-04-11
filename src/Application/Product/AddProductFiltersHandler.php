<?php

declare(strict_types=1);

namespace Jgrc\Shop\Application\Product;

use Jgrc\Shop\Domain\Common\Vo\Uuid;
use Jgrc\Shop\Domain\Filter\Filter;
use Jgrc\Shop\Domain\Filter\FilterNotFound;
use Jgrc\Shop\Domain\Filter\FilterRepository;
use Jgrc\Shop\Domain\Product\Product;
use Jgrc\Shop\Domain\Product\ProductNotFound;
use Jgrc\Shop\Domain\Product\ProductRepository;

class AddProductFiltersHandler
{
    private ProductRepository $productRepository;
    private FilterRepository $filterRepository;

    public function __construct(ProductRepository $productRepository, FilterRepository $filterRepository)
    {
        $this->productRepository = $productRepository;
        $this->filterRepository = $filterRepository;
    }

    public function __invoke(AddProductFilters $command): void
    {
        $product = $this->loadProduct(new Uuid($command->productId()));
        $filters = array_map(
            fn(string $filterId): Filter => $this->loadFilter(new Uuid($filterId)),
            $command->filterIds()
        );

        array_walk($filters, fn(Filter $filter) => $product->addFilter($filter));
        $this->productRepository->save($product);
    }

    private function loadProduct(Uuid $id): Product
    {
        if (!$product = $this->productRepository->byId($id)) {
            throw ProductNotFound::fromId($id);
        }

        return $product;
    }

    private function loadFilter(Uuid $id): Filter
    {
        if (!$filter = $this->filterRepository->byId($id)) {
            throw FilterNotFound::fromId($id);
        }

        return $filter;
    }
}
