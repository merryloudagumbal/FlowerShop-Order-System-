<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $productCount = Product::count();
        $orderCount = Order::count();
        $revenue = Order::sum('total_amount') ?? 0;
        $pendingCount = Order::whereRaw('LOWER(status) = ?', ['pending'])->count();
        $recentOrders = Order::with('items.product')->latest()->take(5)->get();

        $weather = [
            'location' => 'N/A',
            'temperature' => null,
            'condition' => 'Unavailable',
            'humidity' => null,
            'wind_speed' => null,
            'warning' => 'Weather data is currently unavailable.',
        ];

        try {
            $response = Http::timeout(5)->get('https://api.openweathermap.org/data/2.5/weather', [
                'q' => env('OPENWEATHER_CITY', 'Manila'),
                'appid' => env('OPENWEATHER_API_KEY'),
                'units' => 'metric',
            ]);

            if (! $response->successful()) {
                throw new \RuntimeException('OpenWeather API request failed.');
            }

            $data = $response->json();

            if (! is_array($data) || ! isset($data['name'], $data['main']['temp'], $data['weather'][0]['description'], $data['main']['humidity'], $data['wind']['speed'])) {
                throw new \RuntimeException('OpenWeather API payload is invalid.');
            }

            $weather = [
                'location' => $data['name'],
                'temperature' => $data['main']['temp'],
                'condition' => $data['weather'][0]['description'],
                'humidity' => $data['main']['humidity'],
                'wind_speed' => $data['wind']['speed'],
                'warning' => null,
            ];
        } catch (\Throwable $e) {
            Log::warning('OpenWeather API failure: ' . $e->getMessage());
            $weather['warning'] = 'Weather data is currently unavailable.';
        }

        return view('admin.dashboard', compact(
            'productCount',
            'orderCount',
            'revenue',
            'pendingCount',
            'recentOrders',
            'weather',
        ));
    }
}
