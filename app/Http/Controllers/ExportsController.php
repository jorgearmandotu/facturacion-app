<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportsController extends Controller
{
    public function index(){
        return view('admin.exports');
    }
    public function exportInvoices(){
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }

    public function exportsRecibos(){

    }

    public function exportsRemisiones(){

    }

    public function exportInventario(){

    }

    public function exportIngresosDia(){

    }
}
