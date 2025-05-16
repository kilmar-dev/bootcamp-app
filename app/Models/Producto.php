<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    /**
     * Propiedades del modelo:
     * nombre
     * marca
     * categoria
     * 
     */

    use HasFactory;

    protected $fillable = [
        'nombre',
        'marca',
        'categoria'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
