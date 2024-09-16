<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\OrderTwd;
use App\Models\OrderUsd;
use App\Models\OrderJpy;
use App\Models\OrderRmb;
use App\Models\OrderMyr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    /** @var Order */
    private $order;

    /** @var OrderTwd */
    private $orderTwd;

    /** @var OrderUsd */
    private $orderUsd;

    /** @var OrderJpy */
    private $orderJpy;

    /** @var OrderRmb */
    private $orderRmb;

    /** @var OrderMyr */
    private $orderMyr;

    /**
     * construct
     * @param Order $order
     * @param OrderTwd $orderTwd
     * @param OrderUsd $orderUsd
     * @param OrderJpy $orderJpy
     * @param OrderRmb $orderRmb
     * @param OrderMyr $orderMyr
     */
    public function __construct(
        Order $order,
        OrderTwd $orderTwd,
        OrderUsd $orderUsd,
        OrderJpy $orderJpy,
        OrderRmb $orderRmb,
        OrderMyr $orderMyr,
    ) {
        $this->order = $order;
        $this->orderTwd = $orderTwd;
        $this->orderUsd = $orderUsd;
        $this->orderJpy = $orderJpy;
        $this->orderRmb = $orderRmb;
        $this->orderMyr = $orderMyr;
    }

    /**
     * 儲存訂單資料
     * @param array $order
     * @return void
     */
    public function storeOrder(array $order): void
    {
        DB::transaction(function () use ($order) {
            // 儲存到主表
            $this->order::create([
                'order_id' => $order['id'],
                'currency' => $order['currency'],
            ]);
    
            // 根據幣別選擇模型
            $model = $this->getModelByCurrency($order['currency']);
    
            // 儲存到對應的幣別表
            $model->create([
                'id'       => $order['id'],
                'name'     => $order['name'],
                'city'     => $order['address']['city'],
                'district' => $order['address']['district'],
                'street'   => $order['address']['street'],
                'price'    => $order['price'],
                'currency' => $order['currency'],
            ]);
        });
    }

    /**
     * 利用 id 取得幣別
     * @param string $id
     * @return string|null
     */
    public function getCurrencyById(string $id): string|null
    {
        return $this->order
            ->newQuery()
            ->where('order_id', $id)
            ->value('currency');
    }

    /**
     * 利用 id 取得訂單資料
     * @param string $id
     * @param string $currency
     * @return array
     */
    public function getOrderByIdAndCurrency(string $id, string $currency): array
    {
        $model = $this->getModelByCurrency($currency);

        return $model
            ->newQuery()
            ->select(['id', 'name', 'city', 'district', 'street', 'price', 'currency',])
            ->where('id', $id)
            ->get()
            ->all();
    }

    /**
     * 使用幣別來判斷欲使用 model
     * @param string $currency
     * @return Model
     */
    private function getModelByCurrency(string $currency): Model
    {
        switch ($currency) {
            case 'TWD':
                return $this->orderTwd;
            case 'USD':
                return $this->orderUsd;
            case 'JPY':
                return $this->orderJpy;
            case 'RMB':
                return $this->orderRmb;
            case 'MYR':
                return $this->orderMyr;
            default:
                throw new \Exception("Unsupported currency: $currency");
        }
    }
}