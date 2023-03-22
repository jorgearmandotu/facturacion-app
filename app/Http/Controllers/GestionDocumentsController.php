<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GestionDocumentsController extends Controller
{
    public function index(){
        return view('admin.gestion-documents');
    }

    public function shareInvoices(Request $request){
        $dateInitial = $request->dateInitial;
        $dateFinal = $request->dateFinal;
        if($dateInitial == ''){
            return back()->with('fatal', 'Fecha inicial de facturas es requerida');
        }
        if($dateFinal == ''){
            $dateFinal = Carbon::now()->format('Y-m-d');
        }
        $invoices = Invoice::where('invoices.date_invoice', '>=', $dateInitial)
                    ->where('invoices.date_invoice', '<=', $dateFinal)->get();
        return view('admin.gestion-documents', compact('invoices'));
    }
}
