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
    public function index(){
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function store(Request $request){

        try{
            try{
                $validated = $request->validate([
                    'dni' => 'required|unique:users|max:15',
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
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->dni = $request->dni;
                $user->password = bcrypt($request->password);
                $user->phone = $request->phone;
                $user->givePermissionTo('create remision', 'update remision');
                return response()->json(['msg' => 'exito', 'status' => 200], 200);
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
}
