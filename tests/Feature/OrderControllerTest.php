<?php

namespace Tests\Feature;

use App\Events\OrderCreated;
use App\Models\Order;
use App\Models\OrderTwd;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testStoreOrderSuccess(): void
    {
        Event::fake();

        $order = [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road'
            ],
            'price' => 2050,
            'currency' => 'TWD'
        ];

        $response = $this->postJson('/api/orders', $order);

        $response->assertStatus(200)
                 ->assertJson(['message' => '訂單成立']);

        Event::assertDispatched(OrderCreated::class, function ($event) use ($order) {
            return $event->order['id'] === $order['id'];
        });
    }

    public function testStoreOrderFailure(): void
    {
        $order = [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road'
            ],
            'price' => 2050,
            'currency' => 'INVALID'
        ];

        $response = $this->postJson('/api/orders', $order);

        $response->assertStatus(422);
    }

    public function testGetOrderSuccess(): void
    {
        Order::create([
            'order_id' => 'A9999999',
            'currency' => 'TWD',
        ]);

        OrderTwd::create([
            'id'         => 'A9999999',
            'name'       => 'Melody Holiday Inn',
            'city'       => 'taipei-city',
            'district'   => 'da-an-district',
            'street'     => 'fuxing-south-road',
            'price'      => 2050,
            'currency'   => 'TWD',
        ]);

        $response = $this->getJson('/api/orders/A9999999');

        $response->assertStatus(200)
            ->assertJson([
                [
                    'id'       => 'A9999999',
                    'name'     => 'Melody Holiday Inn',
                    'city'     => 'taipei-city',
                    'district' => 'da-an-district',
                    'street'   => 'fuxing-south-road',
                    'price'    => 2050,
                    'currency' => 'TWD',
                ],
            ]);
    }

    public function testGetOrderFailure(): void
    {
        $response = $this->getJson('/api/orders/999');

        $response->assertStatus(200)->assertJson([]);
    }
}