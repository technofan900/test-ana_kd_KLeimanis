<?php

namespace App;

class Validator
{
    public function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function isNotEmpty(string $value): bool
    {
        return $value !== '';
    }

    public function isValidQuantity(int $quantity): bool
    {
        return $quantity > 0;
    }
}
