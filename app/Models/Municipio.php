<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'id:departamento',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function departamento(){
        return $this->belongsTo(Departamento::class);
    }

    public function distrito(){
        return $this->hasMany(Distrito::class);
    }
}
