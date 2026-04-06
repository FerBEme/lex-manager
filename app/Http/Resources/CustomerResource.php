<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class CustomerResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'tipo_documento' => $this->document_type,
            'número_documento' => $this->document_number,
            'rason_social' => $this->company_name,
            'nombres' => $this->names,
            'apellido_paterno' => $this->paternal_surname,
            'apellido_materno' => $this->maternal_surname,
            'correo_electrónico' => $this->email,
            'teléfono' => $this->phone,
            'dirección_casa' => $this->home_address,
            'creado_el' => $this->created_at,
            'actualizado_el' => $this->updated_at,
        ];
    }
}
