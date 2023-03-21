<?php

use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConfigurationCompanyController;
use App\Http\Controllers\ExportsController;
use App\Http\Controllers\GestionInventarioController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LinesController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PendingInvoicesController;
use App\Http\Controllers\PrintInvoiceController;
use App\Http\Controllers\PrintReceiptController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\RemisionController;
use App\Http\Controllers\ShoppingInvoiceController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UsersController;
use App\Models\ListPrices;
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

    Route::get('list-prices', [ProductsController::class, 'listPrices']);
    Route::get('products-list', [ProductsController::class, 'viewProducts'])->name('viewProducts', 'products-list');
    Route::resource('products', ProductsController::class)->name('store','products');

    Route::get('suppliers-list', [SupplierController::class, 'list'])->name('proveedores');
    Route::resource('suppliers', SupplierController::class);
    //Route::get('shooping-nvoice', [ShoppingInvoiceController::class, 'main']);
    //Route::post('shoppinginvoices', [ShoppingInvoiceController::class, 'store'])->name('store', 'shoppinginvoices');

    Route::resource('shopping-invoices', ShoppingInvoiceController::class);

    Route::get('listClients', [ClientController::class, 'listClients']);
    Route::resource('clients', ClientController::class);

    Route::resource('facturacion', InvoiceController::class)->name('store', 'invoices');
    Route::get('printInvoice/{invoice}',[PrintInvoiceController::class, 'index'] )->name('print-invoice');
    Route::resource('pending-invoices', PendingInvoicesController::class);

    Route::resource('receipt', ReceiptController::class);
    Route::get('printReceipt/{receipt}', [PrintReceiptController::class, 'index']);

    Route::post('resolutionStore', [ConfigurationCompanyController::class, 'resolutionStore']);
    Route::resource('config-company', ConfigurationCompanyController::class);

    Route::get('printRemision/{remision}', [RemisionController::class, 'printRemision']);
    Route::get('listRemisiones', [RemisionController::class, 'listRemisiones']);
    Route::resource('remision', RemisionController::class);

    Route::get('exports', [ExportsController::class, 'index']);
    Route::post('exportInvoices', [ExportsController::class, 'exportInvoices']);
    Route::post('exportReceipts', [ExportsController::class, 'exportReceipts']);
    Route::post('exportShoppingInvoices', [ExportsController::class, 'exportShoppingInvoices']);

    Route::get('users-list', [AdminUsersController::class, 'list']);
    Route::resource('adminUsers', AdminUsersController::class);


    // Route::get('listado-prueba', function() {
    //     return DB::table('products as p')
    //     ->join('groups as g', 'p.group_id', '=', 'g.id')
    //     ->join('lines as l', 'l.id', '=', 'g.line_id')
    //     ->join('cstates as c', 'p.cstate_id', '=', 'c.id')
    //     ->join('locations_products as lp', 'lp.product_id', '=', 'p.id')
    //     ->select('p.id', 'p.name', 'l.name as line', 'g.name as group', 'p.code', 'c.value as state', 'reference', 'costo', 'price', 'profit', DB::raw('SUM(lp.stock) as total'))
    //     ->groupBy('p.id', 'p.name', 'l.name', 'g.name', 'p.code', 'c.value', 'p.reference', 'p.costo', 'p.price', 'p.profit')
    //     ->get();

    //     return $products = DB::select('select * from products_list_view');
    // });

});
