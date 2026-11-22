<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // Return all products as JSON response
    public function index()
    {
        return response()->json(Produto::all());
    }


    // Create a new product
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'integer|min:0'
        ]);

        $produto = Produto::create($data);

        // Return the created product as JSON response with 201 status code
        return response()->json($produto, 201);
    }

    // Return the specified product as JSON response
    public function show(Produto $produto)
    {
        return response()->json($produto);
    }

    // Update the specified product in storage
    public function update(Request $request, Produto $produto)
    {
        $data = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'sometimes|required|numeric|min:0',
            'estoque' => 'sometimes|integer|min:0',
        ]);

        $produto->update($data);
        return response()->json($produto);
    }

    // Remove the specified product from storage
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return response()->noContent();
    }
}
