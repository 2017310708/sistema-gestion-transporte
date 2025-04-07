<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('client.orders.index', compact('orders'));
    }

    public function create()
    {
        return view('client.orders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_entrega' => 'required|date|after:today',
            'peso' => 'nullable|numeric|min:0',
            'volumen' => 'nullable|numeric|min:0',
            'instrucciones_especiales' => 'nullable|string',
        ]);

        $order = new Order($validated);
        $order->user_id = Auth::id();
        $order->estado = 'pendiente';
        $order->fecha_solicitud = now();
        $order->save();

        return redirect()->route('client.orders.index')
            ->with('success', 'Pedido creado exitosamente.');
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        return view('client.orders.show', compact('order'));
    }

    public function track()
    {
        $activeOrders = Order::where('user_id', Auth::id())
            ->whereIn('estado', ['asignado', 'en_ruta'])
            ->with('route')
            ->get();
        return view('client.orders.track', compact('activeOrders'));
    }

    public function history()
    {
        $completedOrders = Order::where('user_id', Auth::id())
            ->whereIn('estado', ['entregado', 'cancelado'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('client.orders.history', compact('completedOrders'));
    }
} 