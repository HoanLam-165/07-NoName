<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class SearchOrderByAllFiltersTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_search_orders_by_customer_status_and_category()
    {
        $staff = User::factory()->create();
        $manager = User::factory()->create();

        $customer = User::factory()->create();
        $category = Category::factory()->create(['CategoryName' => 'Đồ ăn']);

        $order = Order::factory()->create([
            'CustomerID' => $customer->UserID,
            'CategoryID' => $category->CategoryID,
        ]);

        // Delivery có Status (đây là status bạn filter)
        $order->delivery()->create([
            'Status'          => 'Delivered',
            'CurrentLocation' => 'HCM',
            'StaffID'         => $staff->UserID,
            'ManagerID'       => $manager->UserID,
        ]);

        // Act: filter theo CustomerID + Delivery.Status + Category
        $response = $this->postJson('/api/searchOrder', [
            'CustomerID' => $customer->UserID,
            'Status'     => 'Delivered',            // Delivery.Status
            'Category'   => $category->CategoryID,
            'RoleID'     => 2,
        ]);

        // Assert
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'CustomerID'     => $customer->UserID,
            'DeliveryStatus' => 'Delivered',        // từ delivery
            'CategoryID'     => $category->CategoryID,
        ]);
    }

    #[Test]
    public function it_returns_404_when_no_orders_match_all_filters()
    {
       
        $response = $this->postJson('/api/searchOrder', [
            'CustomerID' => 999,
            'Status'     => 'Assigned', 
            'Category'   => 3,
            'RoleID'     => 2,
        ]);
        
        $response->assertStatus(404);
        $response->assertExactJson(['message' => 'Không tìm thấy đơn hàng.']);
    }
}
