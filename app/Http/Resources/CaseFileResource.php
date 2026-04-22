<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class CaseFileResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->whenHas('id'),
            'número_expediente' => $this->whenHas('case_number'),
            'órgano_jurisdiccional' => $this->whenHas('judicial_body'),
            'distrito_judicial' => $this->whenHas('judicial_district'),
            'juez' => $this->whenHas('judge'),
            'especialista_legal' => $this->whenHas('legal_specialist'),
            'fecha_inicio' => $this->whenHas('start_date'),
            'proceso' => $this->whenHas('process_type'),
            'especialidad' => $this->whenHas('specialty'),
            'materia(s)' => $this->whenHas('subject'),
            'estado' => $this->whenHas('status'),
            'etapa_procesal' => $this->whenHas('procedural_stage'),
            'fecha_conclusión' => $this->whenHas('end_date'),
            'motivo_conclusión' => $this->whenHas('conclusion_reason'),
            'ubicación' => $this->whenHas('location'),
            'sumilla' => $this->whenHas('summary'),
            'cliente_asignado' => CustomerResource::make($this->whenLoaded('customer')),
            'abogado_asignado' => UserResource::make($this->whenLoaded('lawyer')),
            'creado_el' => $this->whenHas('created_at'),
            'actualizado_el' => $this->whenHas('updated_at'),
        ];
    }
}