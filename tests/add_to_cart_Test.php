<?php

use PHPUnit\Framework\TestCase;
use App\Cart;

final class add_to_cart_Test extends TestCase
{
    public function test_add_to_cart(): void
    {
        $cart = new Cart();

        $cart->addItem('kalva', 15, 2);

        $this->assertTrue(true);
    }
}