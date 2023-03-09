<?php

namespace App\Http\Controllers;

use App\Models\CompanyData;
use App\Models\Invoice;
use App\Models\Receipt;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PrintReceiptController extends Controller
{
    public function index(Receipt $receipt){
        if(!$receipt){
            return 'Recibo no encontrad';
        }

        try{
            $invoice = Invoice::find($receipt->invoice_id);
            $company = CompanyData::latest('id')->first();
            $seller = User::find($receipt->user_id);
            return view('admin.print-receipt', compact('invoice', 'receipt', 'company'));
        } catch(\Exception $e){
            return 'no fue posible generar vista de recibo';
        }
    }
}
