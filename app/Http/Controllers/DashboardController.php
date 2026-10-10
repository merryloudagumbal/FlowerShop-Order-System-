<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();

        // Admin dashboard
        if ($user && $user->role === 'admin') {
            $productCount = Product::count();
            $orderCount = Order::count();
            $revenue = Order::sum('total_amount') ?? 0;
            $pendingCount = Order::whereRaw('LOWER(status) = ?', ['pending'])->count();
            $recentOrders = Order::with('items.product')->latest()->take(5)->get();

            $weatherCity = trim((string) $request->input('weather_city', env('OPENWEATHER_CITY', 'Manila')));
            $weatherCity = $weatherCity !== '' ? $weatherCity : env('OPENWEATHER_CITY', 'Manila');

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
                    'q' => $weatherCity,
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

            return view('dashboard_admin', compact(
                'productCount',
                'orderCount',
                'revenue',
                'pendingCount',
                'recentOrders',
                'weather',
            ));
        }

        // Staff dashboard — show orders and basic stats
        if ($user && $user->role === 'staff') {
            $productCount = Product::count();
            $orderCount = Order::count();
            $recentOrders = Order::with('items.product')->latest()->take(10)->get();

            return view('dashboard_staff', compact('productCount', 'orderCount', 'recentOrders'));
        }

        // Customer dashboard — show only own orders
        $recentOrders = [];
        $orderCount = 0;
        if ($user) {
            $recentOrders = Order::with('items.product')->where('user_id', $user->id)->latest()->get();
            $orderCount = $recentOrders->count();
        }

        return view('dashboard_customer', compact('recentOrders', 'orderCount'));
    }
}
