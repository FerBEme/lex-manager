<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class FileStatusResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'código_estado_archivo' => $this->file_status_code,
            'descripción' => $this->description,
        ];
    }
}