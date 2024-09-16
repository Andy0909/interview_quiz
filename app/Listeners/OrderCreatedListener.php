<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Interfaces\OrderServiceInterface;

class OrderCreatedListener
{
    /** @var OrderServiceInterface */
    private $orderService;

    /**
     * Create the event listener.
     */
    public function __construct(OrderServiceInterface $orderService)
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
