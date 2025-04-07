<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'tipo',
        'descripcion',
        'ubicacion',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
} 