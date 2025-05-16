<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'logs';

    protected $fillable = [
        'user_id',
        'table_id',
        'action',
        'method',
        'endpoint'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'delete_at'
    ];
}
