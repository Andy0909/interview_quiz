<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    public function storeOrder(array $order): void;

    public function getCurrencyById(string $id): string|null;

    public function getOrderByIdAndCurrency(string $id, string $currency): array;
}