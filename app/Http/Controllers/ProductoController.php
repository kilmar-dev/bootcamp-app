<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Producto::all();

        return response()->json([
            'message' => 'Lista de productos',
            'data' => $products
        ],200);
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
        $product = new Producto([
            'nombre' => $request->nombre,
            'marca' => $request->marca,
            'categoria' => $request->categoria,
        ]);

        $product->save();


        return response()->json([
            'message' => 'Producto creado exitosamente.',
            'data' => $product
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Producto::where('id',$id)
                ->first();
        
        if(!$product) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ],404);
        }

        return response()->json([
            'data' => $product
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Producto::where('id',$id)
                ->first();
        
        if(!$product) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ],404);
        }

        $product->nombre = $request->nombre;
        $product->marca = $request->marca;
        $product->categoria = $request->categoria;

        $product->save();

        return response()->json([
            'message' => 'Prodcuto actualizado exitosamente.',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Producto::where('id',$id)
                ->first();
        
        if(!$product) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ],404);
        }

        $product->delete();
        return response()->json([
            'message' => 'Producto eliminado exitosamente.'
        ]);
    }
}
