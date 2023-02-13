<?php

use App\Http\Controllers\GestionInventarioController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinesController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductsController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('', [HomeController::class, 'index'])->name('home');

    Route::get('gestion-inventario', [GestionInventarioController::class, 'index'])->name('gestion-inventario');

    Route::resource('lines', LinesController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('locations', LocationController::class);
    Route::get('products-list', [ProductsController::class, 'viewProducts'])->name('viewProducts', 'products-list');
    Route::resource('products', ProductsController::class)->name('store','products');
});
