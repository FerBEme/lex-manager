<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class CustomerResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->whenHas('id'),
            'tipo_documento' => $this->whenHas('document_type'),
            'número_documento' => $this->whenHas('nro_document'),
            'razón_social' => $this->whenHas('company_name'),
            'nombres' => $this->whenHas('first_name'),
            'apellido_paterno' => $this->whenHas('paternal_name'),
            'apellido_materno' => $this->whenHas('maternal_name'),
            'celular' => $this->whenHas('phone'),
            'correo_electrónico' => $this->whenHas('email'),
            'dirección' => $this->whenHas('address'),
            'creado_el' => $this->whenHas('created_at'),
            'actualizado_el' => $this->whenHas('updated_at'),
        ];
    }
}
