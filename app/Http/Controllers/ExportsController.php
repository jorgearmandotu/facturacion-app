<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Exports\ReceiptsExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportsController extends Controller
{
    public function index(){
        return view('admin.exports');
    }
    public function exportInvoices(Request $request){
        $dateInitial = $request->dateInitial;
        $dateFinal = $request->dateFinal;
        if($dateInitial == ''){
            return back()->with('fatal', 'Fecha inicial de facturas es requerida');
        }
        if($dateFinal == ''){
            $dateFinal = Carbon::now()->format('Y-m-d');
        }
        return Excel::download(new InvoicesExport($dateInitial, $dateFinal), 'Facturas.xlsx');
    }

    public function exportReceipts(Request $request){
        $dateInitial = $request->dateInitial;
        $dateFinal = $request->dateFinal;
        if($dateInitial == ''){
            return back()->with('fatal', 'Fecha inicial de recibos es requerida');
        }
        if($dateFinal == ''){
            $dateFinal = Carbon::now()->format('Y-m-d');
        }
        return Excel::download(new ReceiptsExport($dateInitial, $dateFinal), 'recibos.xlsx');
    }

    public function exportsRemisiones(){

    }

    public function exportInventario(){

    }

    public function exportIngresosDia(){

    }
}
