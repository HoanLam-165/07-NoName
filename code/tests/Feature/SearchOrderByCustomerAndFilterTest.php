<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class SearchOrderByCustomerAndFilterTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_search_orders_by_customer_and_status()
    {
        $user = User::factory()->create(['UserID' => 100]);
        $category = Category::factory()->create(['CategoryID' => 1]);
        $staff = User::factory()->create();
        $manager = User::factory()->create();

        $order = Order::factory()->create([
            'CustomerID' => 100,
            'CategoryID' => 1
        ]);

        $order->delivery()->create([
            'Status' => 'On-going',
            'CurrentLocation' => 'HCM',
            'StaffID' => $staff->UserID,
            'ManagerID' => $manager->UserID
        ]);

        $response = $this->postJson('/api/searchOrder', [
            'CustomerID' => 100,
            'Status' => 'On-going',
            'RoleID' => 2,
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'CustomerID' => 100,
            'DeliveryStatus' => 'On-going'
        ]);
    }

    #[Test]
    public function it_returns_404_when_no_orders_for_customer_and_filter()
    {
        $response = $this->postJson('/api/searchOrder', [
            'CustomerID' => 999,
            'Status' => 'Assigned',
            'RoleID' => 2,
        ]);

        $response->assertStatus(404);
        $response->assertJson(['message' => 'Không tìm thấy đơn hàng.']);
    }
}
