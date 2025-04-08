<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'origen',
        'destino',
        'fecha_salida',
        'fecha_llegada',
        'driver_id',
        'vehicle_id',
        'estado',
        'descripcion',
    ];

    protected $casts = [
        'fecha_salida' => 'datetime',
        'fecha_llegada' => 'datetime',
    ];

    // Relación con conductor
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // Relación con vehículo
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Relación con pedidos
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
