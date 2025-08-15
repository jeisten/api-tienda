<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TiendaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'propietario_id' => 'required|exists:propietarios,id',
            'fecha_permiso' => 'required|date|after_or_equal:today',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'certificado_bomberos' => 'nullable|string|max:255',
            'sayco_acinpro' => 'nullable|string|max:255',
            'latitud' => 'nullable|numeric|between:-90,90',
            'longitud' => 'nullable|numeric|between:-180,180',
            'direccion_tienda' => 'required|string|max:500'
        ];
    }

    public function messages()
    {
        return [
            'propietario_id.required' => 'El propietario es obligatorio',
            'propietario_id.exists' => 'El propietario seleccionado no existe',
            'fecha_permiso.required' => 'La fecha del permiso es obligatoria',
            'fecha_permiso.date' => 'La fecha del permiso debe ser válida',
            'fecha_permiso.after_or_equal' => 'La fecha del permiso no puede ser anterior a hoy',
            'foto.image' => 'El archivo debe ser una imagen',
            'foto.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif',
            'foto.max' => 'La imagen no debe superar los 2MB',
            'certificado_bomberos.string' => 'El certificado de bomberos debe ser texto',
            'certificado_bomberos.max' => 'El certificado de bomberos no puede tener más de 255 caracteres',
            'sayco_acinpro.string' => 'El SAYCO ACINPRO debe ser texto',
            'sayco_acinpro.max' => 'El SAYCO ACINPRO no puede tener más de 255 caracteres',
            'latitud.numeric' => 'La latitud debe ser un número',
            'latitud.between' => 'La latitud debe estar entre -90 y 90',
            'longitud.numeric' => 'La longitud debe ser un número',
            'longitud.between' => 'La longitud debe estar entre -180 y 180',
            'direccion_tienda.required' => 'La dirección de la tienda es obligatoria',
            'direccion_tienda.string' => 'La dirección de la tienda debe ser texto',
            'direccion_tienda.max' => 'La dirección de la tienda no puede tener más de 500 caracteres'
        ];
    }
}
