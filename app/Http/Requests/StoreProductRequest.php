<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|unique:products|max:50',
            'code' => 'required'|'numeric'|'unique:products',
            'costo' => 'required',
            'bar_code' => 'nullable|unique:products',
            //'line' => 'exists:lines,id',
            'group' => 'exists:groups,id',
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'El nombre es requerido',
        'name.unique' => 'El nombre de producto ya esta en uso',
        'name.max' => 'El nombre de producto solo puede contener 50 caracteres',
        'code.required' => 'El código de producto es requerido',
        'code.numeric' => 'El código de producto debe ser numerico',
        'bar_code' => 'El codigo de barras ya esta en uso',
        'code.unique' => 'El código de producto ya esta en uso',
        'costo.required' => 'El costo es requerido',
        'group.exists' => 'La linea y el grupo son requeridos',
    ];
}
}
