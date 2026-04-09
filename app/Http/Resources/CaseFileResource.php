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
            'especialidad_asignada' => $this->relationLoaded('specialty') ? SpecialtyResource::make($this->specialty) : $this->specialty_id,
            'estado_asignado' => $this->relationLoaded('status') ? FileStatusResource::make($this->status) : $this->status_id,
            'localización_asignado' => $this->relationLoaded('location') ? FileLocationResource::make($this->location) : $this->location_id,
            'abogado_asignado' => $this->relationLoaded('lawyer') ? UserResource::make($this->lawyer) : $this->lawyer_id,
            'cliente_asignado' => $this->relationLoaded('customer') ? CustomerResource::make($this->customer) : $this->customer_id,
            'creado_el' => $this->created_at,
            'actualizado_el' => $this->updated_at,
        ];
    }
}