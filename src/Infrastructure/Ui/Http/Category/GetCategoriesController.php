<?php

namespace Jgrc\Shop\Infrastructure\Ui\Http\Category;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetCategoriesController
{
    #[Route('/categories', methods: ['GET'])]
    public function __invoke(): Response
    {
        return new Response('{}', Response::HTTP_OK);
    }
}