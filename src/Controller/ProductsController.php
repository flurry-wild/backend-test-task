<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Controller;

use Raketa\BackendTestTask\Response\JsonResponseFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Raketa\BackendTestTask\Service\ProductsService;

readonly class ProductsController
{
    public function __construct(
        public ProductsService $productsService,
    ) {}

    public function index(RequestInterface $request): ResponseInterface
    {
        $requestJson = $request->getBody()->getContents();

        return JsonResponseFactory::create([
            $this->productsService->list($requestJson)
        ]);
    }
}