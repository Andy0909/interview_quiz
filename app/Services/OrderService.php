<?php 

namespace App\Services;

use App\Repositories\OrderRepository;

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
     * 儲存訂單資料
     * @param array $order
     * @return void
     */
    public function storeOrder(array $order): void
    {
        $this->orderRepository->storeOrder($order);
    }

    /**
     * 利用 id 取得訂單資料
     * @param string $id
     * @return array
     */
    public function getOrderById(string $id): array
    {
        $currency = $this->orderRepository->getCurrencyById($id);

        return is_null($currency) ? [] : $this->orderRepository->getOrderByIdAndCurrency($id, $currency);
    }
}