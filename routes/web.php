<?php

use Illuminate\Support\Facades\Route;


// Define la ruta principal o raiz de la app
Route::get('/', function () {
    return view('welcome');
});


