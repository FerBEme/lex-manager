<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class CaseFileResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'número_expediente' => $this->file_number,
            'órgano_jurisdiccional' => $this->jurisdictional_body,
            'distrito_judicial' => $this->judicial_district,
            'juez(a)' => $this->judge,
            'especialista_legal' => $this->legal_specialist,
            'fecha_inicio' => $this->start_date,
            'proceso' => $this->process,
            'materia' => $this->subject,
            'fecha_finalización' => $this->completion_date,
            'razón_conclusión' => $this->reason_conclusion,
            'especialidad_asignada' => SpecialtyResource::make($this->whenLoaded('specialty')),
            'estado_asignado' => FileStatusResource::make($this->whenLoaded('status')),
            'localización_asignado' => FileLocationResource::make($this->whenLoaded('location')),
            'abogado_asignado' => UserResource::make($this->whenLoaded('lawyer')),
            'cliente_asignado' => CustomerResource::make($this->whenLoaded('customer')),
            'creado_el' => $this->created_at,
            'actualizado_el' => $this->updated_at,
        ];
    }
}