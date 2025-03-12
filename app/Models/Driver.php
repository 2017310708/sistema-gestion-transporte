<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'user_id',
        'dni',
        'licencia',
        'telefono',
        'estado',
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con vehículo
    public function vehicle()
    {
        return $this->hasOne(Vehicle::class);
    }

    // Relación con rutas
    public function routes()
    {
        return $this->hasMany(Route::class);
    }
}
