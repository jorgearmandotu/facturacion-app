<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GestionInventarioController extends Controller
{
    public function index(){
        return view('admin.gestion_inventario');
    }
}
