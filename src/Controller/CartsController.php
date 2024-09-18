<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Raketa\BackendTestTask\Exceptions\CartNotFoundException;
use Raketa\BackendTestTask\Response\JsonResponseFactory;
use Raketa\BackendTestTask\Service\CartsService;

readonly class CartsController
{
    public function __construct(
        public CartsService $cartService,
    ) {
    }

    public function index(): ResponseInterface
    {
        try {
            $carts = $this->cartService->list();
        } catch (CartNotFoundException $e) {
            return JsonResponseFactory::create(['message' => $e->getMessage()], JsonResponseFactory::STATUS_NOT_FOUND);
        }

        return JsonResponseFactory::create($carts);
    }

    public function store(RequestInterface $request): ResponseInterface
    {
        $cart = $this->cartService->add($request->getBody()->getContents());

        return JsonResponseFactory::create([
            'status' => 'success',
            'cart' => $this->cartService->list($cart)
        ]);
    }
}
