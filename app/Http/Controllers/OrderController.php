<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('client')->get();

        return Inertia::render('Orders/Index', [
            'orders' => $orders
        ]);
    }

    public function create()
    {
        $clients = Client::all();

        return Inertia::render('Orders/Create', [
            'clients' => $clients
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'total_price' => 'required|numeric',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index');
    }

    public function edit(Order $order)
    {
        $clients = Client::all();

        return Inertia::render('Orders/Edit', [
            'order' => $order,
            'clients' => $clients
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'total_price' => 'required|numeric',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index');
    }
}
