<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        // Recupera todos os produtos do banco de dados
        $products = Product::all();
        
        // Renderiza a página de listagem de produtos com os dados recuperados
        return Inertia::render('Products/Index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        // Renderiza a página de criação de produto
        return Inertia::render('Products/Create');
    }

    public function store(Request $request)
    {
        // Valida os dados enviados pelo formulário
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Cria um novo produto no banco de dados
        Product::create($request->all());

        // Redireciona de volta para a listagem de produtos
        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        // Renderiza a página de edição de produto com os dados do produto
        return Inertia::render('Products/Edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        // Valida os dados enviados pelo formulário
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Atualiza os dados do produto no banco de dados
        $product->update($request->all());

        // Redireciona de volta para a listagem de produtos
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        // Exclui o produto do banco de dados
        $product->delete();

        // Redireciona de volta para a listagem de produtos
        return redirect()->route('products.index');
    }
}
