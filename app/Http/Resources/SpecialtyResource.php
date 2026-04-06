<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class SpecialtyResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'código_especialidad' => $this->specialty_code,
            'descripción' => $this->description,
        ];
    }
}