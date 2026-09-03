<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

    protected $fillable = [
        'name',
        'email',
        'area_id',
        'training_center_id',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function trainingCenter()
    {
        return $this->belongsTo(Training_center::class, 'training_center_id');
    }
}
