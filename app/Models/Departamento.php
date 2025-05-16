<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'id:pais',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function pais(){
        return $this->belongsTo(Pais::class);
    }

    public function municipios(){
        return $this->hasMany(Municipio::class);
    }
}
