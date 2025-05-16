<?php

namespace App\Http\Controllers;

use App\Models\Distrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class DistritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $distrito = Distrito::select('id','id_municipio','nombre','status')
                                         ->with('municipio')
                                         ->get();

            return response()->json(['data'=> $distrito]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al obtener los datos',
                'error' => $th->getMessage(),
                'line' => $th->getLine(),
                'trace' => $th->getTrace(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validated();

            $distrito = new Distrito([
                'nombre' => $request->nombre,
                'id_municipio' => $request->id_municipio
            ]);

            $distrito->save();

            DB::commit();

            return response()->json([
                'message' => 'Municipio creado de manera exitosa.',
                'data' => $distrito
            ],201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al obtener los datos',
                'error' => $th->getMessage(),
                'line' => $th->getLine(),
                'trace' => $th->getTrace(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $distrito = Distrito::with('municipio')->find($id);

            if(!$distrito) return response()->json(['message'=>'Municipio no encontrado.'],404);

            return response()->json(['message'=>'Distrito', 'Data'=>$distrito],200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al obtener los datos',
                'error' => $th->getMessage(),
                'line' => $th->getLine(),
                'trace' => $th->getTrace(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $request->validated();
            $distrito = Distrito::find($id);
            if(!$distrito) return response()->json(['message'=> 'Distrito no encontrado.'],404);

            $distrito->nombre = $request->nombre;
            $distrito->id_municipio = $request->id_municipio;
            $distrito->save();

            DB::commit();

            return response()->json([
                'message'=> 'Distrito actualizado exitosamente.',
                'data' => $distrito
            ],201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al obtener los datos',
                'error' => $th->getMessage(),
                'line' => $th->getLine(),
                'trace' => $th->getTrace(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $distrito = Distrito::find($id);
            if(!$distrito) return response()->json(['message'=> 'Distrito no encontrado.'],404);

            $distrito->delete();

            DB::commit();

            return response()->json([
                'message'=> 'Distrito eliminado exitosamente.'
            ],201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al obtener los datos',
                'error' => $th->getMessage(),
                'line' => $th->getLine(),
                'trace' => $th->getTrace(),
            ], 500);
        }
    }
}
