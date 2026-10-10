<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FlowerShopFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_inventory_and_order(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($admin);

        $this->post('/products', [
            'name' => 'Rose Bouquet',
            'category' => 'Bouquet',
            'description' => 'Fresh red rose bouquet',
            'price' => 450,
            'stock' => 25,
        ])->assertRedirect('/products');

        $this->assertDatabaseHas('products', ['name' => 'Rose Bouquet']);

        $this->post('/orders', [
            'customer_name' => 'Merry Dagumbal',
            'customer_phone' => '09123456789',
            'delivery_address' => 'Cebu City',
            'status' => 'Pending',
            'items' => [
                ['product_id' => 1, 'quantity' => 2],
            ],
        ])->assertRedirect('/orders');

        $this->assertDatabaseHas('orders', ['customer_name' => 'Merry Dagumbal']);
    }

    public function test_admin_can_update_user_role_and_delete_user(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password123'),
        ]);

        $this->actingAs($admin);

        $user = User::factory()->create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'role' => 'customer',
        ]);

        $this->get("/admin/users/{$user->id}/edit")
            ->assertOk()
            ->assertSee('Edit User');

        $this->put("/admin/users/{$user->id}", [
            'name' => 'Updated Customer',
            'email' => 'updated-customer@example.com',
            'role' => 'staff',
        ])->assertRedirect('/admin/users');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Customer',
            'email' => 'updated-customer@example.com',
            'role' => 'staff',
        ]);

        $this->delete("/admin/users/{$user->id}")
            ->assertRedirect('/admin/users');

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
