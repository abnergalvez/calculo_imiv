<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                    'avatar' => 'file|mimes:png,gif,bmp,jpg|max:3000',
                    'email' => 'required|string|email|max:45|unique:users',
                    'password' => 'required|string|min:6',                   
                ];
                break;
            case 'PUT':
                return [
                    'name' => 'required|string|max:100',
                    'avatar' => 'file|mimes:png,gif,bmp,jpg|max:3000',
                    'email' => 'required|string|email|max:45|unique:users,email,'.$this->id,
                    'password' => $this->password ? 'string|min:6' :'',
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
            'email.required' => 'El Email es obligatorio.',
            'avatar.max' => 'La foto de perfil no debe ser mayor que 2000 kilobytes.',
            'avatar.mimes' => 'La archivo de foto de perfil debe ser .png, .gif, .bmp, .jpg .',
            'password.min'  => 'La Contraseña debe contener mas de 6 digitos',
        ];
    }
}
