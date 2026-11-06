<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training_center extends Model
{
    use HasFactory;

    
     protected $table = 'training_centers';

    protected $attributes = [
        'imagen_url' => '',
        'imagen_public_id' => '',
    ];

    protected $fillable = [
        'name',
        'location',
        'imagen_url',
        'imagen_public_id',
    ];
}
