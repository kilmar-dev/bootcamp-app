<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Http\Requests\Pais\RegisterRequest;
use App\Http\Requests\Pais\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $paises = Pais::all();

            return response()->json([
                'message' => "Paises registrados.",
                'data' => $paises
            ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al obtener los datos',
                'error' => $th->getMessage(),
                'line' => $th->getLine(),
                'trace' => $th->getTrace(),
            ], 500);
        }
    }

    public function filter()
    {
        try {
            $paises =Pais::where('status', '=','1')->paginate(10);
            return response()->json([
                'message' => 'Paises activos',
                'data' => $paises
            ],200);
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
           // $ValidatedData = $request->validated();
            //$pais = Pais::create($ValidatedData);

            $pais = new Pais([
                'nombre' => $request->nombre
            ]);

            $pais->save();
            DB::commit();

            return response()->json([
                'message' => 'Pais creado de manera exitosa',
                'data' => $pais
            ],200);

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
            $pais = Pais::where('id', $id)->where('status', '=','1')->first();
            if(!$pais) return response()->json(['message'=>'Pais no encontrado.'],404);
            
            return response()->json([
                'data' => $pais
            ],200);

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

            $pais = Pais::find($id);
            if(!$pais) return response()->json(['message'=> 'Pais no encontrado.'],404);
            $request->validated();
            $pais->nombre = $request->nombre;
            $pais->status = $request->status;
            $pais->save();

            DB::commit();
            return response()->json(['message'=> 'Pais actualizado exitosamente', 'data'=>$pais],201);
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
            if($id === null) return response()->json(['message'=> 'pais no enviado'],400);

            $pais = Pais::where('id',$id)->where('status','=','1')->first();

            if(!$pais) return response()->json(['message'=> 'Pais no encontrado'],404);

            $pais->delete();
            DB::commit();

            return response()->json([
                'message'=> 'Pais eliminado de manera exitosa.',
                'data' => $pais
            ],200);


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
