<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /** @var OrderService */
    private $orderService;

    /**
     * construct
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * 取得訂單資料
     * @param int $id
     * @return array
     */
    public function getOrder(int $id) : array
    {
        $order = $this->orderService->getOrderById($id);
        
        return $order;
    }
}
