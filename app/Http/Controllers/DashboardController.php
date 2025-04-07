<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Route;
use App\Models\Order;
use App\Models\Driver;

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
                $data['totalVehiculos'] = Vehicle::count();
                $data['totalConductores'] = User::where('rol', 'conductor')->count();
                $data['totalRutas'] = Route::count();
                break;
            case 'conductor':
                $driver = Driver::where('user_id', $user->id)->first();
                $data['rutasAsignadas'] = Route::where('driver_id', $driver->id)
                    ->whereIn('estado', ['programada', 'en_curso'])
                    ->count();
                $data['vehiculoAsignado'] = Vehicle::where('driver_id', $driver->id)->value('placa') ?? 'No asignado';
                $data['entregasPendientes'] = Route::where('driver_id', $driver->id)
                    ->where('estado', 'programada')
                    ->count();
                break;
            case 'cliente':
                $data['pedidosActivos'] = Order::where('user_id', $user->id)
                    ->whereIn('estado', ['pendiente', 'asignado', 'en_ruta'])
                    ->count();
                $data['ultimosPedidos'] = Order::where('user_id', $user->id)
                    ->whereIn('estado', ['entregado', 'cancelado'])
                    ->count();
                $data['rutasEnCurso'] = Order::where('user_id', $user->id)
                    ->where('estado', 'en_ruta')
                    ->count();
                break;
            default:
                $data['tareasPendientes'] = 0;
                $data['notificaciones'] = 0;
                break;
        }

        return view('dashboard', $data);
    }
}
