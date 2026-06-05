<?php

use PHPUnit\Framework\TestCase;
use App\Cart;
use App\Discount;
use App\Validator;

final class whitespace_values_Test extends TestCase
{
    public function test_whitespace_values(): void
    {
        $customer_name = ' ';


        $cart = new Cart();
        $validator = new Validator();
        $discount = new Discount();


        $this->assertFalse($validator->isNotEmpty($customer_name));

        $this->assertFalse($validator->isValidEmail(' '));

        $this->expectException(TypeError::class);
        $cart->addItem(' ', ' ', ' ');
        $discount->applyDiscount(100, ' '); //atlaide var būt tukša, jeb 0% atlaide
    } 
}