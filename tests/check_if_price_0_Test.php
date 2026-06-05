<?php

use PHPUnit\Framework\TestCase;
use App\Cart;

final class check_if_price_0_Test extends TestCase
{
    public function test_check_if_price_0() {
        $cart = new Cart();

        $this->expectException(Exception::class);

        $cart->addItem('klava', 0, 2);
    }
    
}