@extends('layouts.app')

@section('content')
    <div class="layout-grid">
        <aside class="card sidebar">
            <h3 style="margin-top:0;">Navigation</h3>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('orders.index') }}" class="active">Orders</a>
        </aside>

        <div>
            <div class="page-header">
                <h1>Orders</h1>
                <p>Manage customer orders and delivery updates.</p>
            </div>

            <div class="card" style="padding:22px; margin-bottom:22px;">
                <h3 style="margin-top:0;">Create Order</h3>
                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf
                    <div class="form-grid">
                        <div class="field">
                            <label for="customer_name">Customer name</label>
                            <input id="customer_name" type="text" name="customer_name" value="{{ old('customer_name') }}" required>
                            @error('customer_name')<div class="error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field">
                            <label for="customer_phone">Customer phone</label>
                            <input id="customer_phone" type="text" name="customer_phone" value="{{ old('customer_phone') }}" required>
                            @error('customer_phone')<div class="error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field" style="grid-column: 1 / -1;">
                            <label for="delivery_address">Delivery address</label>
                            <textarea id="delivery_address" name="delivery_address" rows="3" required>{{ old('delivery_address') }}</textarea>
                            @error('delivery_address')<div class="error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field">
                            <label for="status">Status</label>
                            <select id="status" name="status">
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="delivered">Delivered</option>
                            </select>
                        </div>
                    </div>

                    <div class="field" style="margin-top:14px;">
                        <label>Items</label>
                        <div class="order-items">
                            @foreach($products as $product)
                                <div class="card" style="padding: 14px 16px; display:flex; justify-content:space-between; align-items:center; gap:12px;">
                                    <div>
                                        <strong>{{ $product->name }}</strong><br>
                                        <small>{{ $product->category }} · ₱{{ number_format($product->price, 2) }}</small>
                                    </div>
                                    <div style="display:flex; align-items:center; gap:10px;">
                                        <label for="qty_{{ $product->id }}">Qty</label>
                                        <input id="qty_{{ $product->id }}" type="number" min="0" name="items[{{ $product->id }}]" value="0" style="width:70px;">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Order</button>
                </form>
            </div>

            <div class="card" style="padding:22px;">
                <h3 style="margin-top:0;">Order List</h3>
                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->customer_phone }}</td>
                                <td>{{ $order->delivery_address }}</td>
                                <td><span class="badge {{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span></td>
                                <td>₱{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6">No orders available yet.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
