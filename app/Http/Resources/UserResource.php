<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
class UserResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->whenHas('id'),
            'tipo_documento' => $this->whenHas('document_type'),
            'número_documento' => $this->whenHas('nro_document'),
            'nombres' => $this->whenHas('first_name'),
            'apellido_paterno' => $this->whenHas('paternal_name'),
            'mpellido_paterno' => $this->whenHas('maternal_name'),
            'correo_electrónico' => $this->whenHas('email'),
            'celular' => $this->whenHas('phone'),
            'registro_CAL' => $this->whenHas('register_cal'),
            'foto_perfil' => $this->profile_photo ? Storage::url($this->profile_photo) : 'https://static.vecteezy.com/system/resources/thumbnails/002/318/271/small/user-profile-icon-free-vector.jpg',
            'rol_asignado' => RoleResource::make($this->whenLoaded('role')),
            'abogado_asignado' => UserResource::make($this->whenLoaded('lawyer')),
            'creado_el' => $this->whenHas('created_at'),
            'actualizado_el' => $this->whenHas('updated_at'),
        ];
    }
}