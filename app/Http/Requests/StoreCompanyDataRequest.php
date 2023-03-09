<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nameComercial' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'regimen' => 'required',
            'activity' => 'required',
        ];
    }

    public function messages(){
        return [
            'nameComercial.required' => 'El nombre comercial es requerido',
            'phone.required' => 'Número de contacto es requerido',
            'address.required' => 'Direcció es requerida',
            'regimen.required' => 'El tipo de regimen es requerido',
            'activity.required' => 'La actividad comercial es requerida',
        ];
    }
}
