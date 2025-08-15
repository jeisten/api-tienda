<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropietarioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:500',
            'telefono' => 'required|string|max:20'
        ];

        // Para actualización, hacer el teléfono único excluyendo el registro actual
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['telefono'] .= '|unique:propietarios,telefono,' . $this->route('propietario');
        } else {
            $rules['telefono'] .= '|unique:propietarios,telefono';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.string' => 'El nombre debe ser texto',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres',
            'direccion.required' => 'La dirección es obligatoria',
            'direccion.string' => 'La dirección debe ser texto',
            'direccion.max' => 'La dirección no puede tener más de 500 caracteres',
            'telefono.required' => 'El teléfono es obligatorio',
            'telefono.string' => 'El teléfono debe ser texto',
            'telefono.max' => 'El teléfono no puede tener más de 20 caracteres',
            'telefono.unique' => 'Este teléfono ya está registrado'
        ];
    }
}
