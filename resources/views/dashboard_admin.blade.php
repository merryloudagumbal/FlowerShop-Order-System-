@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Admin Dashboard</h1>
        <p>Overview of products, orders, and revenue.</p>
    </div>

    <div class="stats">
        <div class="card stat">
            <div class="stat-label">Total Products</div>
            <div class="stat-value">{{ $productCount }}</div>
        </div>
        <div class="card stat">
            <div class="stat-label">Orders</div>
            <div class="stat-value">{{ $orderCount }}</div>
        </div>
        <div class="card stat">
            <div class="stat-label">Revenue</div>
            <div class="stat-value">₱{{ number_format($revenue, 2) }}</div>
        </div>
        <div class="card stat">
            <div class="stat-label">Pending</div>
            <div class="stat-value">{{ $pendingCount }}</div>
        </div>
    </div>

    <div class="card" style="padding: 22px; margin-top: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 18px; flex-wrap: wrap;">
            <h3 style="margin: 0;">Weather Summary</h3>
            <form method="GET" action="{{ route('dashboard') }}" style="display: flex; gap: 8px; align-items: center; margin: 0;">
                <input type="text" name="weather_city" value="{{ request('weather_city', env('OPENWEATHER_CITY', 'Manila')) }}" placeholder="Search city" style="padding: 10px 14px; border: 1px solid #f1d6db; border-radius: 999px; min-width: 170px; font: inherit;" />
                <button type="submit" class="btn btn-primary" style="padding: 10px 16px; border-radius: 999px;">Search</button>
            </form>
        </div>

        @if (! empty($weather['warning']))
            <div class="alert" role="alert">
                {{ $weather['warning'] }}
            </div>
        @endif

        <div style="display: grid; grid-template-columns: repeat(5, minmax(0, 1fr)); gap: 14px;">
            <div class="card stat" style="padding: 18px; min-height: 120px;">
                <div class="stat-label">Location</div>
                <div class="stat-value" style="font-size: 1.5rem;">{{ $weather['location'] }}</div>
            </div>
            <div class="card stat" style="padding: 18px; min-height: 120px;">
                <div class="stat-label">Temperature</div>
                <div class="stat-value" style="font-size: 1.5rem;">
                    {{ is_numeric($weather['temperature']) ? number_format((float) $weather['temperature'], 1) : 'N/A' }}°C
                </div>
            </div>
            <div class="card stat" style="padding: 18px; min-height: 120px;">
                <div class="stat-label">Condition</div>
                <div class="stat-value" style="font-size: 1.1rem;">{{ $weather['condition'] }}</div>
            </div>
            <div class="card stat" style="padding: 18px; min-height: 120px;">
                <div class="stat-label">Humidity</div>
                <div class="stat-value" style="font-size: 1.5rem;">
                    {{ is_numeric($weather['humidity']) ? $weather['humidity'] : 'N/A' }}%
                </div>
            </div>
            <div class="card stat" style="padding: 18px; min-height: 120px;">
                <div class="stat-label">Wind Speed</div>
                <div class="stat-value" style="font-size: 1.5rem;">
                    {{ is_numeric($weather['wind_speed']) ? number_format((float) $weather['wind_speed'], 1) : 'N/A' }} m/s
                </div>
            </div>
        </div>
    </div>

    <div style="margin: 24px 0;">
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage Users</a>
    </div>

    <div class="card" style="padding: 22px;">
        <h3 style="margin-top:0;">Recent Orders</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->delivery_address }}</td>
                            <td><span class="badge {{ strtolower($order->status) }}">{{ $order->status }}</span></td>
                            <td>₱{{ number_format($order->total_amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No orders have been created yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
