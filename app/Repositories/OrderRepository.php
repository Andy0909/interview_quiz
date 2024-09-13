<?php

namespace App\Repositories;

use App\Models\OrderTwd;

class OrderRepository
{
    /** @var OrderTwd */
    private $orderTwd;

    /**
     * construct
     * @param OrderTwd $orderTwd
     */
    public function __construct(OrderTwd $orderTwd) 
    {
        $this->orderTwd = $orderTwd;
    }

    /**
     * 利用 id 取得 order 資料
     * @param int $id
     * @return OrderTwd[]
     */
    public function getOrderById(int $id): array
    {
        return $this->orderTwd
            ->newQuery()
            ->where('id', $id)
            ->get()
            ->all();
    }
}