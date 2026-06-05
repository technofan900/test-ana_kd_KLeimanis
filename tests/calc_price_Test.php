<?php

use PHPUnit\Framework\TestCase;
use App\Cart;

final class calc_price_Test extends TestCase
{
    public function test_calc_price() {
        $cart = new Cart();

        $cart->addItem('klava', 15, 2);
        $this->assertEquals(30, $cart->getTotal());
    }
}