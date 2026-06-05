<?php

use PHPUnit\Framework\TestCase;
use App\Cart;

final class negative_amount_Test extends TestCase
{
    public function test_negative_amount() {
        $cart = new Cart();

        $this->expectException(Exception::class);

        $cart->addItem('klava', 15, -20);
    }
    
}
