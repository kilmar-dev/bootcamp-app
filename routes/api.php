<?php

use App\Http\Controllers\PaisController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\DistritoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Models\Distrito;
use App\Models\Municipio;
use Illuminate\Routing\Route as RoutingRoute;

Route::prefix('user')->group(function(){
    Route::get('/index',[UsuarioController::class, 'index']);
    Route::post('/create',[UsuarioController::class, 'store']);
    Route::put('/update/{id}',[UsuarioController::class, 'update']);
    Route::delete('/delete/{id}',[UsuarioController::class, 'destroy']);
    Route::get('/show/{id}',[UsuarioController::class, 'show']);
    Route::get('/filtro',[UsuarioController::class, 'filter']);
});

Route::prefix('product')->group(function(){
    Route::get('/index',[ProductoController::class, 'index']);
    Route::post('/create',[ProductoController::class, 'store']);
    Route::put('/update/{id}',[ProductoController::class, 'update']);
    Route::delete('/delete/{id}',[ProductoController::class, 'destroy']);
    Route::get('/show/{id}',[ProductoController::class, 'show']);
});

Route::prefix('paises')->group(function(){
    Route::get('/index',[PaisController::class,'index']);
    Route::post('/create',[PaisController::class,'store']);
    Route::put('/update/{id}',[PaisController::class,'update']);
    Route::delete('/delete/{id}',[PaisController::class,'destroy']);
    Route::get('/show/{id}',[PaisController::class,'show']);
});

Route::prefix('departamentos')->group(function(){
    Route::get('/index',[DepartamentoController::class,'index']);
    Route::post('/create',[DepartamentoController::class,'store']);
    Route::put('/update/{id}',[DepartamentoController::class,'update']);
    Route::delete('/delete/{id}',[DepartamentoController::class,'destroy']);
    Route::get('/show/{id}',[DepartamentoController::class,'show']);
    Route::put('/enable/{id}',[DepartamentoController::class,'enable']);
    Route::put('/sidable/{id}',[DepartamentoController::class,'desable']);
});

Route::prefix('municipios')->group(function(){
    Route::get('/index',[MunicipioController::class,'index']);
    Route::post('/create',[MunicipioController::class,'store']);
    Route::put('/update/{id}',[MunicipioController::class,'update']);
    Route::delete('/delete/{id}',[MunicipioController::class,'destroy']);
    Route::get('/show/{id}',[MunicipioController::class,'show']);
});

Route::prefix('distritos')->group(function(){
    Route::get('/index',[DistritoController::class,'index']);
    Route::post('/create',[DistritoController::class,'store']);
    Route::put('/update/{id}',[DistritoController::class,'update']);
    Route::delete('/delete/{id}',[DistritoController::class,'destroy']);
    Route::get('/show/{id}',[DistritoController::class,'show']);
});
?>