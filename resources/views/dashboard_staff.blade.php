@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Staff Dashboard</h1>
        <p>Orders and quick actions for florists and staff.</p>
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
    </div>

    <div class="card" style="padding: 22px;">
        <h3 style="margin-top:0;">Recent Orders</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->status }}</td>
                            <td>₱{{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                <form method="POST" action="/orders">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <button class="btn">View</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No orders available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
