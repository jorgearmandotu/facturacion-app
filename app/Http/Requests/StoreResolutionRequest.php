<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResolutionRequest extends FormRequest
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
            'resolution' => 'required',
            'date' => 'required|date',
            'expiration' => 'required|date',
            'validity' => 'required',
            'prefijo' => 'required',
            'initial' => 'required|numeric',
            'final' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'resolution.required' => 'El número de resolución es requerido',
            'date.required' => 'Fecha de resolución es requerida',
            'date.date' => 'Formato de fecha de resolución no es valido',
            'expiration.required' => 'Fecha de vencimiento es requerida',
            'expiration.date' => 'Fecha de vencimiento no tiene un formato permitido',
            'validity.required' => 'Tiempo de vigencia es requerido',
            'prefijo.required' => 'El prefijo es requerido',
            'inital.required' => 'Número inicial es requerido',
            'inital.numeric' => 'Número inicial no tiene formato valido',
            'final.required' => 'Número final es requerido',
            'final.numeric' => 'Número final no tiene formato valido',
        ];
    }
}
