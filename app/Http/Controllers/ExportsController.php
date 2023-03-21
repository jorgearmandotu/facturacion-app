<?php

namespace App\Http\Controllers;

use App\Exports\IngresosExport;
use App\Exports\InvoicesExport;
use App\Exports\MovimientoProductExport;
use App\Exports\ReceiptsExport;
use App\Exports\ShoppingInvoicesExport;
use App\Models\Product;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:exports')->only(['index']);
        $this->middleware('can:exports-invoice', ['only' => ['exportInvoices']]);
        $this->middleware('can:exports-receipt', ['only' => ['exportReceipts']]);
    }

    public function index(){
        $products = Product::all();
        return view('admin.exports', compact('products'));
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
        return Excel::download(new InvoicesExport($dateInitial, $dateFinal), 'Facturas de venta.xlsx');
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
        return Excel::download(new ReceiptsExport($dateInitial, $dateFinal), 'recibos de caja.xlsx');
    }

    public function exportShoppingInvoices(Request $request){
        $dateInitial = $request->dateInitial;
        $dateFinal = $request->dateFinal;
        if($dateInitial == ''){
            return back()->with('fatal', 'Fecha inicial de faturas de compra es requerida');
        }
        if($dateFinal == ''){
            $dateFinal = Carbon::now()->format('Y-m-d');
        }
        return Excel::download(new ShoppingInvoicesExport($dateInitial, $dateFinal), 'facturas de compra.xlsx');
    }

    public function exportsRemisiones(){

    }

    public function exportIngresos(Request $request) {
        $dateInitial = $request->dateInitial;
        $dateFinal = $request->dateFinal;
        if($dateInitial == ''){
            return back()->with('fatal', 'Fecha inicial de ingresos es requerida');
        }
        if($dateFinal == ''){
            $dateFinal = Carbon::now()->format('Y-m-d');
        }
        return Excel::download(new IngresosExport($dateInitial, $dateFinal), 'ingresos por fecha.xlsx');
    }

    public function exportMovimientoProducto(Request $request){
        $dateInitial = $request->dateInitial;
        $product = Product::find($request->product);
        if($dateInitial == ''){
            return back()->with('fatal', 'Fecha inicial de movimiento es requerida');
        }
        if(!$product){
            return back()->with('fatal', 'No se encontro producto');
        }
        return Excel::download(new MovimientoProductExport($product, $dateInitial), 'movimiento de producto'.$product->name.'.xlsx');
    }

    public function exportInventario(){

    }

    public function exportIngresosDia(){

    }
}
