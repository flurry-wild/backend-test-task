<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Service;

use Raketa\BackendTestTask\Domain\Cart;
use Raketa\BackendTestTask\Domain\CartItem;
use Raketa\BackendTestTask\Exceptions\CartNotFoundException;
use Raketa\BackendTestTask\Repository\CartManager;
use Raketa\BackendTestTask\Repository\ProductRepository;
use Raketa\BackendTestTask\View\CartView;
use Ramsey\Uuid\Uuid;


class CartsService
{
    public function __construct(
        public CartManager $cartManager,
        public CartView $cartView,
        public ProductRepository $productRepository
    ) {

    }

    public function one(): Cart
    {
        return $this->cartManager->getCart();
    }

    public function list(): array
    {
        $cart = $this->one();

        if (!$cart) {
            throw new CartNotFoundException();
        }

        return $this->cartView->toArray($cart);
    }

    public function add(string $jsonData): Cart
    {
        $rawRequest = json_decode($jsonData, true);
        $product = $this->productRepository->getByUuid($rawRequest['productUuid']);

        $cart = $this->one();
        $cart->addItem(new CartItem(
            Uuid::uuid4()->toString(),
            $product->getUuid(),
            $product->getPrice(),
            $data['quantity'],
        ));

        return $cart;
    }
}