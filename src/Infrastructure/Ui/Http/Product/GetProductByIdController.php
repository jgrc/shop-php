<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Ui\Http\Product;

use Jgrc\Shop\Application\Product\GetProductById;
use Jgrc\Shop\Domain\Common\Bus\QueryBus;
use Jgrc\Shop\Domain\Product\View\ProductProjection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetProductByIdController
{
    private QueryBus $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    #[Route('/products/{id}', methods: ['GET'])]
    public function __invoke(string $id): Response
    {
        /** @var ProductProjection $product */
        $product = $this->queryBus->query(new GetProductById($id));
        return new Response(
            (string) json_encode(
                [
                    'id' => $product->id(),
                    'name' => $product->name(),
                    'price' => $product->price(),
                ]
            ),
            Response::HTTP_OK
        );
    }
}
