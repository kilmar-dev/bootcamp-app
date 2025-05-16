<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    /**
     * Propiedades del modelo
     * nombre
     * apellido
     * email
     * password
     * status
     */

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'status'
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];
}
