<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Services\OrderService;

class OrderCreatedListener
{
    /** @var OrderService */
    private $orderService;

    /**
     * Create the event listener.
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;

        $this->orderService->storeOrder($order);
    }
}
