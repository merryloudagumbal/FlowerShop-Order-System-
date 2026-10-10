<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AdminDashboardWeatherTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_shows_weather_fallback_when_api_is_unavailable(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password123'),
        ]);

        Http::fake([
            'https://api.openweathermap.org/data/2.5/weather*' => Http::response([
                'cod' => 500,
                'message' => 'Internal Server Error',
            ], 500),
        ]);

        $this->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertOk()
            ->assertSee('Weather data is currently unavailable.')
            ->assertSee('Weather Dashboard');
    }
}
