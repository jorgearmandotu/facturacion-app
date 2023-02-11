<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\Tax;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {
        return view('admin.products');
    }

    public function store(Request $request) {
        //guardar producto
    }

    public function create(){
        $lines = Line::all();
        $taxes = Tax::all();
        return view('admin.create_products',compact('lines', 'taxes'));
    }
}
