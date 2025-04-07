<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'cantidad',
        'costo',
        'kilometraje',
        'fecha_carga',
        'tipo_combustible',
        'estacion_servicio',
        'comprobante',
    ];

    protected $casts = [
        'fecha_carga' => 'datetime',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
} 