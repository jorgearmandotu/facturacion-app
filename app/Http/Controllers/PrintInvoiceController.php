<?php

namespace App\Http\Controllers;

use App\Models\CompanyData;
use App\Models\Invoice;
use App\Models\Resolution;
use App\Models\Tercero;
use App\Models\User;
use Illuminate\Http\Request;

class PrintInvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:print-invoices')->only(['index']);
    }

    function index(Invoice $invoice){
        //consultar factura
        if(!$invoice){
            return 'Factura no encontrada';
        }
        $client = Tercero::find($invoice->client_id);
        $seller = User::select('name')->find($invoice->user_id);
        $company = CompanyData::latest('id')->first();
        $resolution = Resolution::find($invoice->resolution);//buscar resolucon con que se hizo factura

        // return $invoice->dataInvoices[0]->product;
        return view('admin.print.print-invoice', compact('invoice', 'client', 'seller', 'company', 'resolution'));
    }
}
