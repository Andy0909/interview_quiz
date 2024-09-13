<?php 

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Models\OrderTwd;

class OrderService
{
    /** @var OrderRepository */
    private $orderRepository;

    /**
     * construct
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository) 
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * 利用 id 取得 order 資料
     * @param int $id
     * @return OrderTwd[]
     */
    public function getOrderById(int $id): array
    {
        return $this->orderRepository->getOrderById($id);
    }
}