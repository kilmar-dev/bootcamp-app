<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Http\Requests\Departamento\RegisterRequest;
use App\Http\Requests\Departamento\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Throwable;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $departamentos = Departamento::select('id','id_pais','nombre','status')
                                         ->with('pais')
                                         ->get();

            return response()->json(['data'=> $departamentos]);
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
    public function store(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            $request->validated();

            $departamento = new Departamento([
                'nombre' => $request->nombre,
                'id_pais' => $request->id_pais
            ]);

            $departamento->save();

            DB::commit();

            return response()->json([
                'message' => 'Departamento creado de manera exitosa.',
                'data' => $departamento
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
            $departamento = Departamento::with('pais')->find($id);

            if(!$departamento) return response()->json(['message'=>'Departamanto no encontrado.'],404);

            return response()->json(['message'=>'Departamento', 'Data'=>$departamento],200);
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
    public function update(UpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $request->validated();
            $departamento = Departamento::find($id);
            if(!$departamento) return response()->json(['message'=> 'Departamento no encontrado.'],404);

            $departamento->nombre = $request->nombre;
            $departamento->id_pais = $request->id_pais;
            $departamento->save();

            DB::commit();

            return response()->json([
                'message'=> 'Departamento actualizado exitosamente.',
                'data' => $departamento
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

            $departamento = Departamento::find($id);
            if(!$departamento) return response()->json(['message'=> 'Departamento no encontrado.'],404);

            $departamento->delete();

            DB::commit();

            return response()->json([
                'message'=> 'Departamento eliminado exitosamente.'
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

    public function disable($id)
    {
        try {
            DB::beginTransaction();
            $departamento = Departamento::find($id);
            if(!$departamento) return response()->json(['message'=> 'Departamento no encontrado.'],404);

            $departamento->status = 2;
            $departamento->save();

            DB::commit();

            return response()->json([
                'message'=> 'Departamento desactivado exitosamente.',
                'data'=> $departamento
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

    public function enable($id)
    {
        try {
            DB::beginTransaction();
            $departamento = Departamento::find($id);
            if(!$departamento) return response()->json(['message'=> 'Departamento no encontrado.'],404);

            $departamento->status = 1;
            $departamento->save();

            DB::commit();

            return response()->json([
                'message'=> 'Departamento activado exitosamente.',
                'data'=> $departamento
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