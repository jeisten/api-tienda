<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TiendaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'propietario_id' => $this->propietario_id,
            'propietario' => new PropietarioResource($this->whenLoaded('propietario')),
            'fecha_permiso' => $this->fecha_permiso->format('Y-m-d'),
            'foto_url' => $this->foto_url ? asset('storage/' . $this->foto_url) : null,
            'certificado_bomberos' => $this->certificado_bomberos,
            'sayco_acinpro' => $this->sayco_acinpro,
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'direccion_tienda' => $this->direccion_tienda,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
