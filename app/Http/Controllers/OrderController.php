<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('client', 'products')->get();

        return Inertia::render('Orders/Index', [
            'orders' => $orders,
        ]);
    }

    public function create()
    {
        $clients = Client::all();
        $products = Product::all();

        return Inertia::render('Orders/Create', [
            'clients' => $clients,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|array',
            'products.*.id' => 'exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        foreach ($request->products as $productData) {
            $product = Product::find($productData['id']);

            // Valida se a quantidade solicitada é maior que o estoque disponível
            if ($productData['quantity'] > $product->stock) {
                return redirect()->back()->withErrors([
                    'products' => "A quantidade solicitada para o produto {$product->name} excede o estoque disponível."
                ]);
            }
        }

        $order = Order::create([
            'client_id' => $request->client_id,
            'total_price' => 0,
            'status' => 'pending',
        ]);

        $totalPrice = 0;
        foreach ($request->products as $productData) {
            $product = Product::find($productData['id']);
            $quantity = $productData['quantity'];
            $price = $product->price * $quantity;
            $order->products()->attach($product->id, ['quantity' => $quantity, 'price' => $price]);

            // Reduz o estoque
            $product->decrement('stock', $quantity);

            $totalPrice += $price;
        }

        $order->update(['total_price' => $totalPrice]);

        return redirect()->route('orders.index');
    }

    public function edit(Order $order)
    {
        $clients = Client::all();
        $products = Product::all();

        return Inertia::render('Orders/Edit', [
            'order' => $order->load('products'),
            'clients' => $clients,
            'products' => $products,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|array',
            'products.*.id' => 'exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        foreach ($request->products as $productData) {
            $product = Product::find($productData['id']);

            // Valida se a quantidade solicitada é maior que o estoque disponível
            if ($productData['quantity'] > $product->stock) {
                return redirect()->back()->withErrors([
                    'products' => "A quantidade solicitada para o produto {$product->name} excede o estoque disponível."
                ]);
            }
        }

        // Devolver o estoque dos produtos atuais antes de atualizar
        foreach ($order->products as $product) {
            $product->increment('stock', $product->pivot->quantity);
        }

        $order->products()->detach();

        $totalPrice = 0;
        foreach ($request->products as $productData) {
            $product = Product::find($productData['id']);
            $quantity = $productData['quantity'];
            $price = $product->price * $quantity;
            $order->products()->attach($product->id, ['quantity' => $quantity, 'price' => $price]);

            // Reduzir novamente o estoque
            $product->decrement('stock', $quantity);

            $totalPrice += $price;
        }

        $order->update([
            'client_id' => $request->client_id,
            'total_price' => $totalPrice,
            'status' => $request->status ?? 'pending',
        ]);

        return redirect()->route('orders.index');
    }

    public function destroy(Order $order)
    {
        // Devolver o estoque dos produtos antes de excluir
        foreach ($order->products as $product) {
            $product->increment('stock', $product->pivot->quantity);
        }

        $order->products()->detach();
        $order->delete();

        return redirect()->route('orders.index');
    }
}