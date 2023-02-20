<?php

use App\Http\Controllers\GestionInventarioController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinesController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShoppingInvoiceController;
use App\Http\Controllers\SupplierController;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

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
    Route::get('suppliers-list', [SupplierController::class, 'list'])->name('proveedores');
    Route::resource('suppliers', SupplierController::class);
    //Route::get('shooping-nvoice', [ShoppingInvoiceController::class, 'main']);
    //Route::post('shoppinginvoices', [ShoppingInvoiceController::class, 'store'])->name('store', 'shoppinginvoices');
    Route::resource('shopping-invoices', ShoppingInvoiceController::class);
    Route::get('listado-prueba', function() {
        return DB::table('products as p')
        ->join('groups as g', 'p.group_id', '=', 'g.id')
        ->join('lines as l', 'l.id', '=', 'g.line_id')
        ->join('cstates as c', 'p.cstate_id', '=', 'c.id')
        ->join('locations_products as lp', 'lp.product_id', '=', 'p.id')
        ->select('p.id', 'p.name', 'l.name as line', 'g.name as group', 'p.code', 'c.value as state', 'reference', 'costo', 'price', 'profit', DB::raw('SUM(lp.stock) as total'))
        ->groupBy('p.id', 'p.name', 'l.name', 'g.name', 'p.code', 'c.value', 'p.reference', 'p.costo', 'p.price', 'p.profit')
        ->get();

        return $products = DB::select('select * from products_list_view');
    });

    // Route::resource('clients', )
});
