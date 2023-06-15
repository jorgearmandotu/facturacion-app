<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersCreate;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\MessageBag;

class AdminUsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin-users.index')->only(['index', 'list']);
        $this->middleware('can:admin-users.store', ['only' => ['create', 'store', 'show', 'update']]);
    }

    public function index(){
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function store(Request $request){

        try{

            try{
                $validated = $request->validate([
                    'dni' => 'required|unique:users,dni|max:15',
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'numeric|nullable',
                    'password' => 'required|confirmed|min:8',
                ],
                [
                'dni.required' => 'El número de identificacion es requerido.',
                'dni.unique' => 'El número de identificacion ya esta registrado.',
                'dni.max' => 'El número de identificacion excede longitud admitida.',
                'name' => 'El nombre es requerido.',
                'email.required' => 'El email es requerido.',
                'email.email' => 'El email no tiene formato valido.',
                'phone.numeric' => 'el número de contacto solo puede contener numeros',
                'password.required' => 'La contraseña es requerida',
                'password.min' => 'La contraseña debe contener minimo 8 caracteres',
                'password.confirmed' => 'Las contraseñas no coincide',
                ]);
            }catch(\Illuminate\Validation\ValidationException $e){
                $errors = new MessageBag($e->errors());

                return response()->json([
                    'errors' => $errors,'status' => 400
                ], 200);
            }
            if($validated){
                $user = User::where('dni', $request->dni)->first();
                if($user){
                    return response()->json([
                        'errors' => 'Identificación de usuario ya esta registrada','status' => 400
                    ], 200);
                }
                $user = new User();
                $user->name = strtoupper($request->name);
                $user->email =strtoupper($request->email);
                $user->dni = $request->dni;
                $user->password = bcrypt($request->password);
                $user->phone = $request->phone;
                if($request->remision){
                    $user->givePermissionTo('remision.index', 'remision.store', 'printRemision');
                }
                if($request->invoice){
                    $user->givePermissionTo('invoices.store', 'invoices.index', 'print-invoices');
                }
                if($request->receipt){
                    $user->givePermissionTo('receipt.index', 'receipt.store', 'print-receipt');
                }
                if($request->pendingInvoices){
                    $user->givePermissionTo('pending-invoices');
                }
                if($request->listRemision){
                    $user->givePermissionTo( 'listRemisiones' );
                }
                if($request->createProducts){
                    $user->givePermissionTo( 'products.store', 'products.update', 'products.index');
                }
                if($request->listProducts){
                    $user->givePermissionTo( 'products-list' );
                }
                if($request->gestionInventario){
                    $user->givePermissionTo( 'gestion-inventario', 'lines.index', 'lines.store', 'lines.update', 'groups.index',
                    'groups.store', 'groups.update', 'locations.index', 'locations.store', 'locations.update' );
                }
                if($request->shoppingInvoices){
                    $user->givePermissionTo( 'shopping-invoices.store' );
                }
                if($request->terceros){
                    $user->givePermissionTo( 'list-terceros', 'terceros.index', 'terceros.store', 'terceros.show', 'terceros.update' );
                }
                if($request->suppliers){
                    $user->givePermissionTo( 'suppliers-list', 'suppliers.index' );
                }
                if($request->reports){
                    $user->givePermissionTo( 'exports', 'exports-invoice' , 'exports-receipt' );
                }
                if($request->configCompany){
                    $user->givePermissionTo( 'resolution-store', 'config-company.index', 'config-company.store' );
                }
                if($request->users){
                    $user->givePermissionTo( 'admin-users.index', 'admin-users.store' );
                }
                if($request->gestionDocuments){
                    $user->givePermissionTo('gestion-documents');
                }
                if($request->discharges){
                    $user->givePermissionTo('discharges');
                }
                if($request->transferLocations){
                    $user->givePermissionTo('transferLocations');
                }
                if($request->profile){
                    $user->givePermissionTo('profile');
                }
                if($request->estadisticas){
                    $user->givePermissionTo('estadisticas');
                }

                $user->save();
                return response()->json(['msg' => 'Usuario creado con exito', 'status' => 200], 200);
            }

                // if($validate->passes()){
                //     return response()->json(['msg' => $request->name, 'status' => 200], 200);
                // }else{
                //     return response()->json(['msg' => $validate, 'status' => 200], 200);
                // }
            }catch(\Exception $e){
                return response()->json(['msg' => 'No fue posible realizar la operacion error: '.$e, 'status' => 400], 200);
        }

    }

    public function show($user){
        $user = User::select('name', 'email', 'id', 'dni', 'phone')->where('id', $user)->first();
        if($user->hasAllPermissions(['remision.index', 'remision.store', 'printRemision'])){
            $user->push('remision');
        }
        return response()->json($user);

    }

    public function list(){
        $users = User::all();
        return DataTables()->collection($users)->toJson();
    }


    public function update($id, Request $request) {
        $user = User::find($id);
        if($user){
            try{
                $validated = $request->validate([
                    'dni' => 'required|max:15',
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'numeric|nullable',
                    'password' => 'nullable|confirmed|min:8',
                ],
                [
                'dni.required' => 'El número de identificacion es requerido.',
                'dni.max' => 'El número de identificacion excede longitud admitida.',
                'name' => 'El nombre es requerido.',
                'email.required' => 'El email es requerido.',
                'email.email' => 'El email no tiene formato valido.',
                'phone.numeric' => 'el número de contacto solo puede contener numeros',
                'password.min' => 'La contraseña debe contener minimo 8 caracteres',
                'password.confirmed' => 'Las contraseñas no coincide',
                ]);
            }catch(\Illuminate\Validation\ValidationException $e){
                $errors = new MessageBag($e->errors());

                return response()->json([
                    'errors' => $errors,'status' => 400
                ], 200);
            }
            $user->name = strtoupper($request->name);
                $user->email =strtoupper($request->email);
                $user->dni = $request->dni;
                if($request->password){
                    $user->password = bcrypt($request->password);
                }
                $user->phone = $request->phone;
                if($request->remision){
                    $user->givePermissionTo('remision.index', 'remision.store', 'printRemision');
                }else{
                    $user->revokePermissionTo(['remision.index', 'remision.store', 'printRemision']);
                }
                if($request->invoice){
                    $user->givePermissionTo('invoices.store', 'invoices.index', 'print-invoices');
                }else{
                    $user->revokePermissionTo(['invoices.store', 'invoices.index', 'print-invoices']);
                }
                if($request->receipt){
                    $user->givePermissionTo('receipt.index', 'receipt.store', 'print-receipt');
                }else{
                    $user->revokePermissionTo(['receipt.index', 'receipt.store', 'print-receipt']);
                }
                if($request->pendingInvoices){
                    $user->givePermissionTo('pending-invoices');
                }else{
                    $user->revokePermissionTo(['pending-invoices']);
                }
                if($request->listRemision){
                    $user->givePermissionTo( 'listRemisiones' );
                }else{
                    $user->revokePermissionTo( ['listRemisiones' ]);
                }
                if($request->createProducts){
                    $user->givePermissionTo( 'products.store', 'products.update', 'products.index');
                }else{
                    $user->revokePermissionTo([ 'products.store', 'products.update', 'products.index']);
                }
                if($request->listProducts){
                    $user->givePermissionTo( 'products-list' );
                }else{
                    $user->revokePermissionTo( ['products-list'] );
                }
                if($request->gestionInventario){
                    $user->givePermissionTo( 'gestion-inventario', 'lines.index', 'lines.store', 'lines.update', 'groups.index',
                    'groups.store', 'groups.update', 'locations.index', 'locations.store', 'locations.update' );
                }else{
                    $user->revokePermissionTo([ 'gestion-inventario', 'lines.index', 'lines.store', 'lines.update', 'groups.index',
                    'groups.store', 'groups.update', 'locations.index', 'locations.store', 'locations.update'] );
                }
                if($request->shoppingInvoices){
                    $user->givePermissionTo( 'shopping-invoices.store' );
                }else{
                    $user->revokePermissionTo( ['shopping-invoices.store'] );
                }
                if($request->terceros){
                    $user->givePermissionTo( 'list-terceros', 'terceros.index', 'terceros.store', 'terceros.show', 'terceros.update' );
                }else{
                    $user->revokePermissionTo( ['list-terceros', 'terceros.index', 'terceros.store', 'terceros.show', 'terceros.update' ]);
                }
                if($request->suppliers){
                    $user->givePermissionTo( 'suppliers-list', 'suppliers.index' );
                }else{
                    $user->revokePermissionTo( ['suppliers-list', 'suppliers.index'] );
                }
                if($request->reports){
                    $user->givePermissionTo( 'exports', 'exports-invoice' , 'exports-receipt' );
                }else{
                    $user->revokePermissionTo( ['exports', 'exports-invoice' , 'exports-receipt'] );
                }
                if($request->configCompany){
                    $user->givePermissionTo( 'resolution-store', 'config-company.index', 'config-company.store' );
                }else{
                    $user->revokePermissionTo( ['resolution-store', 'config-company.index', 'config-company.store'] );
                }
                if($request->users){
                    $user->givePermissionTo( 'admin-users.index', 'admin-users.store' );
                }else{
                    $user->revokePermissionTo( ['admin-users.index', 'admin-users.store'] );
                }
                if($request->gestionDocuments){
                    $user->givePermissionTo('gestion-documents');
                }else{
                    $user->revokePermissionTo('gestion-documents');
                }
                if($request->discharges){
                    $user->givePermissionTo('discharges');
                }else{
                    $user->revokePermissionTo('discharges');
                }
                if($request->transferLocations){
                    $user->givePermissionTo('transferLocations');
                }else{
                    $user->revokePermissionTo('transferLocations');
                }
                if($request->profile){
                    $user->givePermissionTo('profile');
                }else{
                    $user->revokePermissionTo('profile');
                }
                if($request->estadisticas){
                    $user->givePermissionTo('estadisticas');
                }else{
                    $user->revokePermissionTo('estadisticas');
                }

                $user->save();
                return response()->json(['msg' => 'Datos de usuario actualizados con exito', 'status' => 200], 200);
        }

    }

    public function stateUser($id, Request $request){
        $user = User::find($id);
        if($user){
            $user->is_active = !$user->is_active;
            $user->save();
            return response()->json(['msg' => 'Estado de usuario cambiado con exito', 'status' => 200], 200);
        }
        return response()->json(['msg' => 'No fue posible realizar la operacón veriqfique que el usuario exista', 'status' => 400], 200);
    }
}
