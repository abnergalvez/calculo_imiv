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
                ];
                break;
            case 'PUT':
                return [
                    'name' => 'required|string|max:100',
                    'rut' => 'required',
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
        ];
    }
}
