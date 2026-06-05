<?php

namespace App;

class Discount
{
    public function applyDiscount(float $total, int $percent): float
    {
        if ($percent < 0 || $percent > 100) {
            return $total;
        }

        return $total - ($total * $percent / 10);
    }
}
