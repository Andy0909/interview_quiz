<?php 

namespace App\Services;

use App\Interfaces\OrderServiceInterface;
use App\Interfaces\OrderRepositoryInterface;

class OrderService implements OrderServiceInterface
{
    /** @var OrderRepositoryInterface */
    private $orderRepository;

    /**
     * construct
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(OrderRepositoryInterface $orderRepository) 
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