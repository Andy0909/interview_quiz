<?php

namespace App\Interfaces;

interface OrderServiceInterface
{
    public function storeOrder(array $order): void;

    public function getOrderById(string $id): array;
}