<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class FileLocationResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'código_ubicación' => $this->file_location_code,
            'nombre' => $this->name,
            'descripción' => $this->description,
        ];
    }
}