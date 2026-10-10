<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('items.product')->latest()->get();
        $products = Product::latest()->get();

        return view('orders.index', compact('orders', 'products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:50'],
            'delivery_address' => ['required', 'string', 'max:500'],
            'status' => ['required', 'string', 'in:Pending,In Production,Ready for Delivery/Pickup,Delivered'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'items' => ['required', 'array'],
        ]);

        $items = [];
        foreach ($request->input('items', []) as $key => $value) {
            if (is_array($value)) {
                $items[] = $value;
                continue;
            }

            $quantity = (int) $value;
            if ($quantity > 0) {
                $items[] = [
                    'product_id' => (int) $key,
                    'quantity' => $quantity,
                ];
            }
        }

        if ($items === []) {
            return back()->withErrors([
                'items' => 'Please add at least one product to the order.',
            ]);
        }

        $totalAmount = 0;

        foreach ($items as $item) {
            $product = Product::findOrFail($item['product_id']);

            if ($product->stock < $item['quantity']) {
                return back()->withErrors([
                    'items' => 'Not enough stock for ' . $product->name . '.',
                ]);
            }

            $totalAmount += $product->price * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'delivery_address' => $validated['delivery_address'],
            'status' => $validated['status'],
            'notes' => $validated['notes'] ?? null,
            'total_amount' => $totalAmount,
        ]);

        foreach ($items as $item) {
            $product = Product::findOrFail($item['product_id']);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'unit_price' => $product->price,
            ]);

            $product->decrement('stock', $item['quantity']);
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }
}
