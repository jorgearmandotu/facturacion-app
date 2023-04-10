<?php

namespace App\Http\Controllers;

use App\Models\CompanyData;
use App\Models\Location;
use App\Models\LocationProduct;
use App\Models\Product;
use App\Models\ProductsMovements;
use App\Models\TransferLocation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GestionInventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:gestion-inventario')->only(['index']);
        $this->middleware('can:transferLocations')->only([ 'transferLocation', 'transferProducts', 'transferLocationTable', 'transferProduct', 'printTransfer', 'transferProductsList']);
    }
    public function index()
    {
        return view('admin.gestion_inventario');
    }

    public function transferLocation()
    {
        $locations = LocationProduct::all();
        return view('admin.transfer-location', compact('locations'));
    }

    public function transferLocationTable()
    {
        $locations = LocationProduct::join('locations', 'location_id', 'locations.id')
            ->join('products', 'products.id', 'product_id')
            ->select('code', 'products.name as product', 'locations.name as location', 'stock')->get();
        return DataTables()->collection($locations)->toJson();
    }

    public function transferProduct(Request $request)
    {
        $product = Product::where('code', $request->code)->first();
        $locationFrom = Location::find($request->from);
        $locationTo = Location::find($request->to);
        $quantity = $request->quantity;
        if (!$product || !$locationFrom || !$locationTo || !$quantity || $quantity < 1) {
            return response()->json(['msg' => 'Verifique información que todos los datos sean correctos.', 'status' => 400], 200);
        }
        //hacer traslado de bodega y movimientyo de producto tipo TransferLocation
        //valido cantidades

        $stockFrom = LocationProduct::where('product_id', $product->id)->where('location_id', $locationFrom->id)->first();
        if (!$stockFrom || $stockFrom->stock < $quantity) {
            return response()->json(['msg' => 'La Cantidad supera las existencias del producto.', 'status' => 400], 200);
        }
        DB::beginTransaction();
        try {
            $stockTo = LocationProduct::where('product_id', $product->id)->where('location_id', $locationTo->id)->first();
            if (!$stockTo) {
                $stockTo = new LocationProduct();
                $stockTo->location_id = $locationTo->id;
                $stockTo->product_id = $product->id;
                $stockTo->stock = $quantity;
            } else {
                $stockTo->stock += $quantity;
            }
            $stockTo->save();
            $stockFrom->stock -= $quantity;
            $stockFrom->save();

            //creo documento
            $document = new TransferLocation();
            $oldDocument = TransferLocation::latest('id')->first();
            $document->number = (!$oldDocument) ? 1 : $oldDocument->id + 1;
            $document->product_id = $product->id;
            $document->fromLocation = $locationFrom->id;
            $document->toLocation = $locationTo->id;
            $document->quantity = $quantity;
            $document->user_id = Auth::id();
            $document->save();

            $movement = new ProductsMovements();
            $movement->type = 'Salida';
            $movement->product_id = $product->id;
            $movement->quantity = $quantity;
            $movement->saldo = $stockFrom->stock;
            $movement->document_type = 'TransferLocation';
            $movement->document_id = $document->number;
            $movement->location_id = $locationFrom->id;
            $movement->save();
            $movement = new ProductsMovements();
            $movement->type = 'Entrada';
            $movement->product_id = $product->id;
            $movement->quantity = $quantity;
            $movement->saldo = $stockTo->stock;
            $movement->document_type = 'TransferLocation';
            $movement->document_id = $document->number;
            $movement->location_id = $locationTo->id;
            $movement->save();

            DB::commit();
            return response()->json(['msg' => 'Translado realizado con exito.', 'transfer' => $document->number, 'status' => 200], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => 'No fue posible realizar la operación contacte al administrador del sistema.' . $e, 'status' => 400], 200);
        }
    }

    public function printTransfer($number)
    {
        $transfer = TransferLocation::where('number', $number)->get();
        $seller = User::select('name')->find($transfer[0]->user_id);
        $company = CompanyData::latest('id')->first();
        return view('admin.print.print-transfer-location', compact('transfer', 'seller', 'company'));
    }

    public function transferProducts()
    {
        $locations = LocationProduct::all();
        return view('admin.transfer-products');
    }

    public function transferProductsList(Request $request)
    {
        if ($request->newCode) {
            $oldDocument = TransferLocation::latest('id')->first();
            DB::beginTransaction();
            for ($i = 0; $i < count($request->newCode); $i++) {
                $product = Product::where('code', $request->newCode[$i])->first();
                $locationFrom = Location::find($request->newFrom[$i]);
                $locationTo = Location::find($request->newTo[$i]);
                $quantity = $request->newQuantity[$i];
                if (!$product || !$locationFrom || !$locationTo || !$quantity || $quantity < 1) {
                    DB::rollBack();
                    return back()->with('fatal', 'Verifique información, que todos los datos sean correctos.');
                }
                //hacer traslado de bodega y movimientyo de producto tipo TransferLocation
                //valido cantidades

                $stockFrom = LocationProduct::where('product_id', $product->id)->where('location_id', $locationFrom->id)->first();
                if (!$stockFrom || $stockFrom->stock < $quantity) {
                    DB::rollBack();
                    return back()->with('fatal', 'La Cantidad supera las existencias del producto.');
                }
                try {
                    $stockTo = LocationProduct::where('product_id', $product->id)->where('location_id', $locationTo->id)->first();
                    if (!$stockTo) {
                        $stockTo = new LocationProduct();
                        $stockTo->location_id = $locationTo->id;
                        $stockTo->product_id = $product->id;
                        $stockTo->stock = $quantity;
                    } else {
                        $stockTo->stock += $quantity;
                    }
                    $stockTo->save();
                    $stockFrom->stock -= $quantity;
                    $stockFrom->save();

                    //creo documento
                    $document = new TransferLocation();
                    $document->number = (!$oldDocument) ? 1 : $oldDocument->id + 1;
                    $document->product_id = $product->id;
                    $document->fromLocation = $locationFrom->id;
                    $document->toLocation = $locationTo->id;
                    $document->quantity = $quantity;
                    $document->user_id = Auth::id();
                    $document->save();

                    $movement = new ProductsMovements();
                    $movement->type = 'Salida';
                    $movement->product_id = $product->id;
                    $movement->quantity = $quantity;
                    $movement->saldo = $stockFrom->stock;
                    $movement->document_type = 'TransferLocation';
                    $movement->document_id = $document->number;
                    $movement->location_id = $locationFrom->id;
                    $movement->save();
                    $movement = new ProductsMovements();
                    $movement->type = 'Entrada';
                    $movement->product_id = $product->id;
                    $movement->quantity = $quantity;
                    $movement->saldo = $stockTo->stock;
                    $movement->document_type = 'TransferLocation';
                    $movement->document_id = $document->number;
                    $movement->location_id = $locationTo->id;
                    $movement->save();

                } catch (\Exception $e) {
                    DB::rollBack();
                    return back()->with('fatal', 'No fue posible realizar la operación contacte al administrador del sistema.' . $e);
                }
            }
            DB::commit();
            return back()->with('success', 'Traslado realizado con exito')->with('transfer', $document->number);
        }else{
            return back()->with('fatal', 'Verifique información, que todos los datos sean correctos.');
        }
    }
}
