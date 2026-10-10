@extends('layouts.app')

@section('content')
    <section class="hero">
        <div>
            <span class="eyebrow">Flower Shop Order System</span>
            <h1>Fresh flowers, smooth orders, happier customers.</h1>
            <p>
                Manage flower inventory, track custom arrangements, update delivery status,
                and generate billing records from one simple dashboard designed for local flower shops.
            </p>
            <div class="nav-links" style="justify-content:flex-start; margin-top: 8px;">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Open Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Access System</a>
                @endauth
            </div>
        </div>
        <div class="card hero-box">
            <div class="stats">
                <div class="stat card">
                    <div class="stat-label">Orders</div>
                    <div class="stat-value">1.2k</div>
                </div>
                <div class="stat card">
                    <div class="stat-label">Inventory</div>
                    <div class="stat-value">320</div>
                </div>
                <div class="stat card">
                    <div class="stat-label">Clients</div>
                    <div class="stat-value">840</div>
                </div>
                <div class="stat card">
                    <div class="stat-label">Revenue</div>
                    <div class="stat-value">₱68k</div>
                </div>
            </div>
        </div>
    </section>

    <section class="feature-grid">
        <div class="card feature">
            <div class="icon">💐</div>
            <h3>Order Tracking</h3>
            <p>Log custom bouquets, monitor fulfillment stages, and update order status in real time.</p>
        </div>
        <div class="card feature">
            <div class="icon">📦</div>
            <h3>Inventory Control</h3>
            <p>Track flower stock, supply categories, add-ons, and receive low-stock alerts for timely restocking.</p>
        </div>
        <div class="card feature">
            <div class="icon">🧾</div>
            <h3>Billing & Receipts</h3>
            <p>Generate accurate totals, create customer receipts, and keep operational reporting organized.</p>
        </div>
    </section>
@endsection
