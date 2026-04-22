<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class FolderResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->whenHas('id'),
            'nombre_carpeta' => $this->whenHas('name'),
            'carpeta_asignada' => FolderResource::make($this->whenLoaded('parent')),
            'expediente_asignado' => CaseFileResource::make($this->whenLoaded('case')),
            'creado_por' => UserResource::make($this->whenLoaded('creator')),
            'creado_el' => $this->whenHas('created_at'),
            'actualizado_el' => $this->whenHas('updated_at'),
        ];
    }
}