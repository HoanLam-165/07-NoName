<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class SearchOrderByIdTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_search_orders_by_customer_id()
    {
        $user = User::factory()->create(['UserID' => 100]);
        $category = Category::factory()->create(['CategoryID' => 1]);

        Order::factory()->create([
            'CustomerID' => $user->UserID,
            'CategoryID' => $category->CategoryID,
            'FromLocation' => 'HCM',
            'ToLocation' => 'HN',
            'Total' => 200,
            'Charge' => 20,
        ]);

        $otherUser = User::factory()->create(['UserID' => 200]);
        $otherCategory = Category::factory()->create(['CategoryID' => 2]);

        Order::factory()->create([
            'CustomerID' => $otherUser->UserID,
            'CategoryID' => $otherCategory->CategoryID,
            'FromLocation' => 'DN',
            'ToLocation' => 'HN',
            'Total' => 300,
            'Charge' => 30,
        ]);

        $response = $this->postJson('/api/searchOrder', [
            'CustomerID' => 200,
            'RoleID' => 2, 
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['CustomerID' => 200]);
        $response->assertJsonCount(1, 'orders');
    }

    #[Test]
    public function it_returns_404_when_no_orders_for_customer_id()
    {
        $response = $this->postJson('/api/searchOrder', [
            'CustomerID' => 999,
            'RoleID' => 2,
        ]);

        $response->assertStatus(404);
        $response->assertJson(['message' => 'Không tìm thấy đơn hàng.']);
    }
}