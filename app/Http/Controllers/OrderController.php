<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Http\Requests\OrderRequest;
use App\Interfaces\OrderServiceInterface;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /** @var OrderServiceInterface */
    private $orderService;

    /**
     * construct
     * @param OrderServiceInterface $orderService
     */
    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * 儲存訂單資料
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function store(OrderRequest $request): JsonResponse
    {
        // 檢查傳入參數
        $validated = $request->validated();

        // 建立事件
        event(new OrderCreated($validated));

        return response()->json(['message' => '訂單成立'], 200);
    }

    /**
     * 取得訂單資料
     * @param string $id
     * @return JsonResponse
     */
    public function getOrder(string $id): JsonResponse
    {
        $order = $this->orderService->getOrderById($id);

        return response()->json($order, 200);
    }
}
