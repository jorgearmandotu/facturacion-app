<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ShoppingInvoiceController extends Controller
{
    // public function main(){
    //     return View()
    // }

    public function create(){
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('admin.shopping_invoices', compact('suppliers', 'products'));
    }
}
