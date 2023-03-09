<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\CompanyData;
use App\Models\Invoice;
use App\Models\Resolution;
use App\Models\User;
use Illuminate\Http\Request;

class PrintInvoiceController extends Controller
{
    function index(Invoice $invoice){
        //consultar factura
        if(!$invoice){
            return 'Factura no encontrada';
        }
        $client = Clients::find($invoice->client_id);
        $seller = User::select('name')->find($invoice->user_id);
        $company = CompanyData::latest('id')->first();
        $resolution = Resolution::find($invoice->resolution);//buscar resolucon con que se hizo factura

        // return $invoice->dataInvoices[0]->product;
        return view('admin.print-invoice', compact('invoice', 'client', 'seller', 'company', 'resolution'));
    }
}
