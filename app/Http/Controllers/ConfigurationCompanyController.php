<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyDataRequest;
use App\Http\Requests\StoreResolutionRequest;
use App\Models\CompanyData;
use App\Models\CpaymentMethods;
use App\Models\Cstate;
use App\Models\Resolution;
use Illuminate\Http\Request;

class ConfigurationCompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:config-company.index')->only(['index']);
        $this->middleware('can:config-company.store', ['only' => ['create', 'store']]);
        $this->middleware('can:resolution-store', ['only' => ['resolutionStore']]);
    }

    public function index(){
        $resolution = Resolution::latest('id')->first();
        $company = CompanyData::latest('id')->first();
        //$methods_payment = CpaymentMethods::all();
        return view('admin.configuration-company', compact('resolution', 'company'));
    }

    public function store(StoreCompanyDataRequest $request){
        try{
            $company = CompanyData::latest('id')->first();
            $company->name_view = $request->nameComercial;
            $company->address = $request->address;
            $company->phone = $request->phone;
            $company->regimen = $request->regimen;
            $company->email = $request->email;
            $company->actividad_economica = $request->activity;
            $company->save();
            return back()->with('success', 'Datos de emprea actualizados');
        }catch(\Exception $e){
            return back()->with('fatal', 'No fue posible actualizar datos de empresa');
        }
    }

    public function resolutionStore(StoreResolutionRequest $request){
        try{
            $company = CompanyData::latest('id')->first();
            $company->usa_resolucion_factura = ($request->stateResolution) ? true : false;
            $company->save();
            $resolution = new Resolution();
            if($request->stateResolution){
                $resolution->number = $request->resolution;
                $resolution->date_resolution = $request->date;
                $resolution->expiration_date = $request->expiration;
                $resolution->validity = $request->validity;
                $resolution->prefijo = strtoupper($request->prefijo);
                $resolution->initial_number = $request->initial;
                $resolution->final_number = $request->final;
                $resolution->save();
            }else{
                $resolution->prefijo = ($request->prefijo) ? $request->prefijo : '';
                $resolution->initial_number = $request->initial;
                $resolution->final_number = $request->final;
                $resolution->save();
            }
            return back()->with('success', 'Datos de resolución actualizados');
        }catch(\Exception $e){
            return back()->with('fatal', 'No fue posible actualizar datos de resolución, verifique que los datos sean correctos');
        }
    }


}
