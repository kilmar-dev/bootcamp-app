<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $municipio = Municipio::select('id','id_departamento','nombre','status')
                                         ->with('departamento')
                                         ->get();

            return response()->json(['data'=> $municipio]);
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

            $municipio = new Municipio([
                'nombre' => $request->nombre,
                'id_departamento' => $request->id_departamento
            ]);

            $municipio->save();

            DB::commit();

            return response()->json([
                'message' => 'Municipio creado de manera exitosa.',
                'data' => $municipio
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
            $municipio = Municipio::with('departamento')->find($id);

            if(!$municipio) return response()->json(['message'=>'Municipio no encontrado.'],404);

            return response()->json(['message'=>'Municipio', 'Data'=>$municipio],200);
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
            $municipio = Municipio::find($id);
            if(!$municipio) return response()->json(['message'=> 'Municipio no encontrado.'],404);

            $municipio->nombre = $request->nombre;
            $municipio->id_departamento = $request->id_departamento;
            $municipio->save();

            DB::commit();

            return response()->json([
                'message'=> 'Municipio actualizado exitosamente.',
                'data' => $municipio
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

            $municipio = Municipio::find($id);
            if(!$municipio) return response()->json(['message'=> 'Municipio no encontrado.'],404);

            $municipio->delete();

            DB::commit();

            return response()->json([
                'message'=> 'Municipio eliminado exitosamente.'
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
