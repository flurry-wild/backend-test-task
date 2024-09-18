<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Service;

use Raketa\BackendTestTask\View\ProductsView;

class ProductsService
{
    public function __construct(
        public ProductsService $productsService,
        public ProductsView $productsVew
    ) {}

    public function list(string $jsonData): array
    {
        $rawRequest = json_decode($jsonData, true);

        return $this->productsVew->toArray($rawRequest['category']);
    }
}