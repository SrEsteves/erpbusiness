<?php

namespace App\Http\Controllers;


use App\Models\Client;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Buscar as contagens necessárias no banco de dados
        $clientsCount = Client::count();
        $productsCount = Product::count();
        $salesToday = Order::whereDate('created_at', now()->toDateString())->count();
        $totalRevenue = Order::sum('total_price'); // Assumindo que você tenha um campo 'total' em sua tabela de orders

        // Passar os dados para o componente Vue via Inertia
        return Inertia::render('Dashboard', [
            'clientsCount' => $clientsCount,
            'productsCount' => $productsCount,
            'salesToday' => $salesToday,
            'totalRevenue' => $totalRevenue,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
