<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'route_id',
        'origen',
        'destino',
        'descripcion',
        'estado',
        'fecha_solicitud',
        'fecha_entrega',
        'peso',
        'volumen',
        'instrucciones_especiales',
    ];

    protected $casts = [
        'fecha_solicitud' => 'datetime',
        'fecha_entrega' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
} 