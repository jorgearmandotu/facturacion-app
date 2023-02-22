<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Invoice extends Controller
{
    public function index(){
        return view('admin.invoices');
    }
}
