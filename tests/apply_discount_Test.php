<?php

use PHPUnit\Framework\TestCase;
use App\Cart;
use App\Discount;

final class apply_discount_Test extends TestCase
{
    public function test_apply_discount(): void
    {
        $cart = new Cart();
        $discount = new Discount();

        $cart->addItem('klava', 100, 1);
        $total = $cart->getTotal();

        $discounted_total = $discount->applyDiscount($total, 20);

        $this->assertEquals(80, $discounted_total);
    }
}