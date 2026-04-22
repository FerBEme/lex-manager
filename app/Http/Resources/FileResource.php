<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
class FileResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->whenHas('id'),
            'nombre_archivo' => $this->whenHas('file_name') . ' (v' . $this->version . ')',
            'ruta_archivo' => $this->file_path ? Storage::url($this->file_path) : null,
            'tipo_archivo' => $this->whenHas('file_type'),
            'folder_asignado' => FolderResource::make($this->whenLoaded('folder')),
            'subido_por' => UserResource::make($this->whenLoaded('uploator')),
            'creado_el' => $this->whenHas('created_at'),
            'actualizado_el' => $this->whenHas('created_at'),
        ];
    }
}