<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarroFilterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'marca' => 'sometimes|integer|exists:marcas,id|nullable',
            'modelo' => 'sometimes|integer|exists:modelos,id|nullable',
            'ano' => 'sometimes|integer|min:1900|max:' . date('Y').'|nullable',
            'quilometragem_min' => 'sometimes|integer|min:0|nullable',
            'quilometragem_max' => 'sometimes|integer|min:0|nullable',
        ];
    }
}
