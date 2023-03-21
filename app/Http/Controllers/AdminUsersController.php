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
        $this->middleware('can:admin-users.store', ['only' => ['create', 'store', 'show']]);
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

    public function show(User $user){
        return response()->json($user);

    }

    public function list(){
        $users = User::all();
        return DataTables()->collection($users)->toJson();
    }
}