<?php

use PHPUnit\Framework\TestCase;
use App\Validator;

final class valid_email_Test extends TestCase
{
    public function test_validate_email(): void
    {
        $email = 'JBērziņš@inbox.lv';

        $validator = new Validator();

        $validator->isValidEmail($email);

        $this->assertTrue(true);
    }

}