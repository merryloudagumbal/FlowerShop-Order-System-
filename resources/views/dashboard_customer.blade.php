@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Your Orders</h1>
        <p>View your order history and status updates.</p>
    </div>

    <div class="card" style="padding: 22px;">
        <h3 style="margin-top:0;">My Orders ({{ $orderCount }})</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->delivery_address }}</td>
                            <td>{{ $order->status }}</td>
                            <td>₱{{ number_format($order->total_amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">You have no orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
