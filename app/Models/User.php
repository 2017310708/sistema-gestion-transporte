<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'password',
        'rol'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}";
    }

    public function isAdmin()
    {
        return $this->rol === 'admin';
    }

    public function isConductor()
    {
        return $this->rol === 'conductor';
    }

    public function isCliente()
    {
        return $this->rol === 'cliente';
    }

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }
}
