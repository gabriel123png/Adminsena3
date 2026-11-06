<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    
    protected $table = 'areas';

    protected $attributes = [
        'descripcion' => '',
        'imagen_url' => '',
        'imagen_public_id' => '',
    ];

    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen_url',
        'imagen_public_id',
    ];
}
