<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:100',
                    'rut' => 'required',
                    'prefix' => 'required|unique:customers'                   
                ];
                break;
            case 'PUT':
                return [
                    'name' => 'required|string|max:100',
                    'rut' => 'required',
                    'prefix' => 'required|unique:customers,prefix,'.$this->id
                ];
                break;
            
            default:
                # code...
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'El Nombre es obligatorio.',
            'rut.required' => 'El RUT es obligatorio.',
            'prefix.required' => 'El prefijo es obligatorio.',
            'prefix.unique' => 'El prefijo debe ser diferente a los demas Clientes.',
        ];
    }
}
