<?php

use PHPUnit\Framework\TestCase;
use App\Cart;
use App\Discount;
use App\Validator;

final class empty_values_Test extends TestCase
{
    public function test_empty_values(): void
    {
        $cart = new Cart();
        $validator = new Validator();
        $discount = new Discount();

        $this->expectException(TypeError::class);

        $cart->addItem('', '', '');

        $this->assertFalse($validator->isValidEmail(''));
        
        $this->assertTrue($discount->applyDiscount(100, '')); //atlaide var būt tukša, jeb 0% atlaide
    }
}