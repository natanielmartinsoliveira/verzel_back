<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModeloRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'marca_id' => 'required|exists:marcas,id',
            'nome' => 'required|string|max:255',
        ];
    }
}
