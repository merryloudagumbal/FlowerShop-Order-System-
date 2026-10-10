@extends('layouts.app')

@section('content')
    <div class="layout-grid">
        <aside class="card sidebar">
            <h3 style="margin-top:0;">Navigation</h3>
            <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('orders.index') }}">Orders</a>
        </aside>

        <div>
            <div class="page-header">
                <h1>Products</h1>
                <p>Add new floral items and monitor the available stock.</p>
            </div>

            <div class="card" style="padding:22px; margin-bottom: 22px;">
                <h3 style="margin-top:0;">Add Product</h3>
                <form method="POST" action="{{ route('products.store') }}">
                    @csrf
                    <div class="form-grid">
                        <div class="field">
                            <label for="name">Product name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required>
                            @error('name')<div class="error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field">
                            <label for="category">Category</label>
                            <input id="category" type="text" name="category" value="{{ old('category') }}" required>
                            @error('category')<div class="error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field">
                            <label for="price">Price</label>
                            <input id="price" type="number" step="0.01" min="0" name="price" value="{{ old('price') }}" required>
                            @error('price')<div class="error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field">
                            <label for="stock">Stock</label>
                            <input id="stock" type="number" min="0" name="stock" value="{{ old('stock') }}" required>
                            @error('stock')<div class="error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="field">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save Product</button>
                </form>
            </div>

            <div class="card" style="padding:22px;">
                <h3 style="margin-top:0;">Current Inventory</h3>
                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category }}</td>
                                <td>₱{{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->stock }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No products available yet.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
