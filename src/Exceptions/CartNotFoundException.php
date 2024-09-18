<?php

namespace Raketa\BackendTestTask\Exceptions;

use Exception;

class CartNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Cart not found');
    }
}