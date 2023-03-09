<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReceiptRequest extends FormRequest
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
            'paymentMethod' => 'required',
            'vlr_payment' => 'required|numeric',
            'prefijo' => 'required',
            'invoice_number' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'paymentMethod.required' => 'Debe sellecionar metodo de pago.',
            'vlr_payment.required' => 'El valor del recibo es requerido.',
            'vlr_payment.numeric' => 'El valor del recibo debe ser númerico.',
            'prefijo.required' => 'El prefijo es requerido.',
            'invoice_number.required' => 'El numero de factura es requerido.',
            'invoice_number.numeric' => 'El numero de factura debe ser un número.',
        ];
    }
}
