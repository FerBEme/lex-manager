<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class RoleResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->whenHas('id'),
            'nombre' => $this->whenHas('name'),
            'creado_el' => $this->whenHas('created_at'),
            'actualizado_el' => $this->whenHas('updated_at'),
        ];
    }
}