<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsuarioRequest extends Request
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
        return [
            'cedula'=>'required|unique:users|max:250',
            'name'=>'required|max:120',
            'telefono'=>'required|max:30',
            'direccion'=>'max:250',
            'email'  => 'unique:users|required',
            'password' => 'min:5|max:40|required'
        ];
    }
}
