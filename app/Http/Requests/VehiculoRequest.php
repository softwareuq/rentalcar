<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VehiculoRequest extends Request
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
          'placa'=>'max:250|required|unique:vehiculos',
          'marca_id'=>'required',
          'tipo_id'=>'required',
          'precioAlquiler'=>'required',
          'foto'=>'required',
          'capacidad'=>'required',
          'modelo'=>'required',
          'color'=>'required|max:30',
          'kilometraje'=>'required',
        ];
    }
}
