<?php

namespace App\Http\Controllers;

use App\Models\LocationProduct;
use Illuminate\Http\Request;

class GestionInventarioController extends Controller
{
    public function index(){
        return view('admin.gestion_inventario');
    }

    public function transferLocation(){
        $locations = LocationProduct::all();
        return view('admin.transfer-location', compact('locations'));
    }
}
