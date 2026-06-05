<?php

namespace App;

class Cart
{
    private array $items = [];

    public function addItem(string $name, float $price, int $quantity): void
    {

        if ($price < 0 || $quantity < 0 || trim($name) === '') {
            return;
        }

        $this->items[] = [
            'name' => trim($name),
            'price' => $price,
            'quantity' => $quantity
        ];
    }

    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }

    public function getItemCount(): int
    {

        $count = 0;

        foreach ($this->items as $item) {
            $count += $item['quantity'];
        }

        return $count;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
