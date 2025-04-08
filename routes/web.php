<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\OrderController;

// Ruta de bienvenida
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    // Rutas de registro
    Route::get('/register/client', [RegisterController::class, 'showClientRegistrationForm'])->name('register.client');
    Route::post('/register/client', [RegisterController::class, 'registerClient'])->name('register.client');
    Route::get('/register/driver', [RegisterController::class, 'showDriverRegistrationForm'])->name('register.driver');
    Route::post('/register/driver', [RegisterController::class, 'registerDriver'])->name('register.driver');
});

// Rutas protegidas
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Admin routes
Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    // Users
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    
    // Vehicles
    Route::resource('vehicles', VehicleController::class);
    
    // Drivers
    Route::resource('drivers', DriverController::class);
    
    // Routes
    Route::resource('routes', RouteController::class);

    // Orders
    Route::resource('orders', OrderController::class);
});

// Rutas para conductores
Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':conductor'])->name('driver.')->prefix('driver')->group(function () {
    Route::get('/routes', [App\Http\Controllers\Driver\RouteController::class, 'current'])->name('routes.current');
    Route::get('/routes/history', [App\Http\Controllers\Driver\RouteController::class, 'history'])->name('routes.history');
    Route::get('/routes/{route}', [App\Http\Controllers\Driver\RouteController::class, 'show'])->name('routes.show');
    Route::put('/routes/{route}/status', [App\Http\Controllers\Driver\RouteController::class, 'updateStatus'])->name('routes.update-status');
    
    // Rutas de incidentes
    Route::get('/incidents/create', [App\Http\Controllers\Driver\IncidentController::class, 'create'])->name('incidents.create');
    Route::post('/incidents', [App\Http\Controllers\Driver\IncidentController::class, 'store'])->name('incidents.store');

    // Rutas de combustible
    Route::get('/fuel/create', [App\Http\Controllers\Driver\FuelController::class, 'create'])->name('fuel.create');
    Route::post('/fuel', [App\Http\Controllers\Driver\FuelController::class, 'store'])->name('fuel.store');
});

// Rutas para clientes
Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':cliente'])->name('client.')->prefix('client')->group(function () {
    Route::get('/orders', [App\Http\Controllers\Client\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [App\Http\Controllers\Client\OrderController::class, 'create'])->name('orders.create');
    Route::get('/orders/track', [App\Http\Controllers\Client\OrderController::class, 'track'])->name('orders.track');
    Route::get('/orders/history', [App\Http\Controllers\Client\OrderController::class, 'history'])->name('orders.history');
    Route::post('/orders', [App\Http\Controllers\Client\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [App\Http\Controllers\Client\OrderController::class, 'show'])->name('orders.show');
});
