<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Route;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'route.driver.user'])
            ->orderBy('created_at', 'desc');

        if ($request->has('status')) {
            switch ($request->status) {
                case 'pending':
                    $query->where('estado', 'pendiente');
                    break;
                case 'active':
                    $query->whereIn('estado', ['asignado', 'en_ruta']);
                    break;
                case 'completed':
                    $query->whereIn('estado', ['entregado', 'cancelado']);
                    break;
            }
        }

        $orders = $query->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'route.driver.user']);
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $routes = Route::whereIn('estado', ['programada', 'en_curso'])
            ->orWhere('id', $order->route_id)
            ->with('driver.user')
            ->get();
        return view('admin.orders.edit', compact('order', 'routes'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'route_id' => 'nullable|exists:routes,id',
            'estado' => 'required|in:pendiente,asignado,en_ruta,entregado,cancelado',
            'fecha_entrega' => 'required|date',
            'descripcion' => 'required|string',
            'instrucciones_especiales' => 'nullable|string',
        ]);

        // Si se asigna una ruta y el estado es pendiente, actualizarlo a asignado
        if ($validated['route_id'] && $order->estado === 'pendiente') {
            $validated['estado'] = 'asignado';
        }

        // Si se quita la ruta y el estado es asignado, volver a pendiente
        if (!$validated['route_id'] && $order->estado === 'asignado') {
            $validated['estado'] = 'pendiente';
        }

        $order->update($validated);

        // Si se asignó una ruta, actualizar el estado de la ruta
        if ($validated['route_id']) {
            $route = Route::find($validated['route_id']);
            if ($route && $route->estado === 'programada') {
                $route->update(['estado' => 'en_curso']);
            }
        }

        return redirect()->route('admin.orders.index')
            ->with('success', 'Pedido actualizado exitosamente');
    }

    public function destroy(Order $order)
    {
        // Si el pedido tiene una ruta asignada, verificar su estado
        if ($order->route_id && !in_array($order->estado, ['entregado', 'cancelado'])) {
            return redirect()->back()
                ->with('error', 'No se puede eliminar un pedido que tiene una ruta asignada y está activo.');
        }

        $order->delete();
        return redirect()->route('admin.orders.index')
            ->with('success', 'Pedido eliminado exitosamente');
    }

    public function pending()
    {
        $orders = Order::where('estado', 'pendiente')
            ->with(['user'])
            ->orderBy('fecha_solicitud', 'asc')
            ->get();
        return view('admin.orders.pending', compact('orders'));
    }

    public function active()
    {
        $orders = Order::whereIn('estado', ['asignado', 'en_ruta'])
            ->with(['user', 'route.driver.user'])
            ->orderBy('fecha_entrega', 'asc')
            ->get();
        return view('admin.orders.active', compact('orders'));
    }

    public function completed()
    {
        $orders = Order::whereIn('estado', ['entregado', 'cancelado'])
            ->with(['user', 'route.driver.user'])
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('admin.orders.completed', compact('orders'));
    }
} 