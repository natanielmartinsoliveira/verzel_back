<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarroRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'marca_id' => 'required|exists:marcas,id',
            'modelo_id' => 'required|exists:modelos,id',
            'ano' => 'required|integer|min:1900|max:' . date('Y'),
            'preco' => 'required|numeric|min:0',
            'quilometragem' => 'required|integer|min:0',
        ];
    }
}
