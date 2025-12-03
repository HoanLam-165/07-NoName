<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class SearchOrderByStatusAndCategoryTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_search_orders_by_status_and_category()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['CategoryID' => 1]);
        $staff = User::factory()->create();
        $manager = User::factory()->create();

        $order = Order::factory()->create([
            'CustomerID' => $user->UserID,
            'CategoryID' => 1
        ]);

        $order->delivery()->create([
            'Status' => 'Assigned',
            'CurrentLocation' => 'HCM',
            'StaffID' => $staff->UserID,
            'ManagerID' => $manager->UserID
        ]);

        $response = $this->postJson('/api/searchOrder', [
            'Status' => 'Assigned',
            'Category' => 1,
            'RoleID' => 2,
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'DeliveryStatus' => 'Assigned',
            'CategoryID' => 1
        ]);
    }

    #[Test]
    public function it_returns_404_when_no_orders_match_status_and_category()
    {
        $response = $this->postJson('/api/searchOrder', [
            'Status' => 'Delivered',
            'Category' => 3,
            'RoleID' => 2,
        ]);

        $response->assertStatus(404);
        $response->assertJson(['message' => 'Không tìm thấy đơn hàng.']);
    }
}
