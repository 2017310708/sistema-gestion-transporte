<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Driver;
use App\Models\Route;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'año',
        'capacidad',
        'estado',
        'driver_id',
    ];

    // Relación con conductor
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // Relación con rutas
    public function routes()
    {
        return $this->hasMany(Route::class);
    }
}
