<?php

namespace Tests\Unit;

use App\Repositories\OrderRepository;
use App\Services\OrderService;
use PHPUnit\Framework\TestCase;
use Mockery;

class OrderServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testStoreOrderSuccess(): void
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
            'currency' => 'TWD'
        ];

        $orderRepositoryMock = Mockery::mock(OrderRepository::class);
        $orderRepositoryMock->shouldReceive('storeOrder')
                            ->once()
                            ->with($order)
                            ->andReturnNull();

        $orderService = new OrderService($orderRepositoryMock);
        $orderService->storeOrder($order);
    }

    public function testStoreOrderFailure(): void
    {
        $this->expectException(\Exception::class);

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

        $orderRepositoryMock = Mockery::mock(OrderRepository::class);
        $orderRepositoryMock->shouldReceive('storeOrder')
                            ->once()
                            ->with($order)
                            ->andThrow(new \Exception("Unsupported currency: INVALID"));

        $orderService = new OrderService($orderRepositoryMock);
        $orderService->storeOrder($order);
    }

    public function testGetOrderByIdSuccess(): void
    {
        $id = 1;
        $currency = 'TWD';
        $order = [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'city' => 'taipei-city',
            'district' => 'da-an-district',
            'street' => 'fuxing-south-road',
            'price' => 2050,
            'currency' => 'TWD'
        ];

        $orderRepositoryMock = Mockery::mock(OrderRepository::class);
        $orderRepositoryMock->shouldReceive('getCurrencyById')
                            ->once()
                            ->with($id)
                            ->andReturn($currency);
        $orderRepositoryMock->shouldReceive('getOrderByIdAndCurrency')
                            ->once()
                            ->with($id, $currency)
                            ->andReturn($order);

        $orderService = new OrderService($orderRepositoryMock);
        $result = $orderService->getOrderById($id);

        $this->assertEquals($order, $result);
    }

    public function testGetOrderByIdFailure(): void
    {
        $this->expectException(\Exception::class);

        $id = 1;

        $orderRepositoryMock = Mockery::mock(OrderRepository::class);
        $orderRepositoryMock->shouldReceive('getCurrencyById')
                            ->once()
                            ->with($id)
                            ->andThrow(new \Exception("Order not found"));

        $orderService = new OrderService($orderRepositoryMock);
        $orderService->getOrderById($id);
    }
}