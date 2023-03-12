<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRemisionRequest extends FormRequest
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
            'document_type' => 'required',
            'dni' => 'required',
            'nameClient' => 'required',
            'phone' => 'required',
            'description' => 'required|min:8',
            'vlr_total' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'document_type.required' => 'El tipo de documento es requerido.',
            'dni.required' => 'La identificación de cliente es requerida.',
            'nameClient.required' => 'El nombre de cliente es requerido.',
            'phone.required' => 'El número de telefono es requerido.',
            'description.required' => 'La descripcion es requerida.',
            'description.min' => 'La descripcion debe contener minimo 8 caracteres.',
            'vlr_total.required' => 'El valor del servicio es requerido.',
            'vlr_total.numeric' => 'El valor del servicio no tiene un formato valido.',
        ];
    }
}
