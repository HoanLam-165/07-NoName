<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class SearchOrderByCategoryTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_search_orders_by_category()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['CategoryID' => 2, 'CategoryName' => 'Đồ ăn']);
        $staff = User::factory()->create();
        $manager = User::factory()->create();

        $order = Order::factory()->create([
            'CustomerID' => $user->UserID,
            'CategoryID' => 2
        ]);

        $order->delivery()->create([
            'Status' => 'On-going',
            'CurrentLocation' => 'HCM',
            'StaffID' => $staff->UserID,
            'ManagerID' => $manager->UserID
        ]);

        $response = $this->postJson('/api/searchOrder', [
            'Category' => 2,
            'RoleID' => 2,
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['CategoryID' => 2]);
    }

    #[Test]
    public function it_returns_404_when_no_orders_for_category()
    {
        $response = $this->postJson('/api/searchOrder', [
            'Category' => 3, 
            'RoleID' => 2,
        ]);

        $response->assertStatus(404);
        $response->assertJson(['message' => 'Không tìm thấy đơn hàng.']);
    }
}
