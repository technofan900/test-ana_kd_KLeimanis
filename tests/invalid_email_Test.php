<?php

use PHPUnit\Framework\TestCase;
use App\Validator;

final class invalid_email_Test extends TestCase
{
    public function test_invalid_email(): void
    {
        $email = 'JBērziņšinboxlv';

        $validator = new Validator();

        $this->assertFalse($validator->isValidEmail($email), 'email went through');
    }

}