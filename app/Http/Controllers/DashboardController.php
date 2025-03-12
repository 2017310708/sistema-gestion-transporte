<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->rol;
        
        // Datos comunes para todos los roles
        $data = [
            'user' => $user,
            'role' => $role,
        ];

        // Datos específicos según el rol
        switch ($role) {
            case 'admin':
                $data['totalVehiculos'] = 25; // Ejemplo, reemplazar con datos reales
                $data['totalConductores'] = 30;
                $data['totalRutas'] = 50;
                break;
            case 'conductor':
                $data['rutasAsignadas'] = 5;
                $data['vehiculoAsignado'] = 'ABC-123';
                $data['entregasPendientes'] = 3;
                break;
            case 'cliente':
                $data['pedidosActivos'] = 2;
                $data['ultimosPedidos'] = 5;
                $data['rutasEnCurso'] = 1;
                break;
            default:
                $data['tareasPendientes'] = 10;
                $data['notificaciones'] = 5;
                break;
        }

        return view('dashboard', $data);
    }
}
