@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Dashboard</h1>
        <p>Overview of products, active orders, and shop performance.</p>
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
                            <td><span class="badge {{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span></td>
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
