<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
class UserResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'tipo_documento' => $this->document_type,
            'número_documento' => $this->document_number,
            'nombres' => $this->names,
            'apellido_paterno' => $this->paternal_surname,
            'apellido_materno' => $this->maternal_surname,
            'correo_electrónico' => $this->email,
            'contraseña' => $this->password,
            'teléfono' => $this->phone,
            'número_colegiatura' => $this->tuition_number,
            'foto_perfil' => $this->profile_photo ? Storage::url($this->profile_photo) : 'https://static.vecteezy.com/system/resources/thumbnails/002/318/271/small/user-profile-icon-free-vector.jpg',
            'está_activo' => $this->is_active,
            'último_inicio_el' => $this->last_login_at,
            'abogado_asignado' => $this->lawyer,
            'creado_el' => $this->created_at,
            'actualizado_el' => $this->updated_at,
            // 'roles_asignados' => RoleResource::collection($this->whenLoaded('roles')) : null,
            // 'especialidades_asignadas' => SpecialtyResource::collection($this->whenLoaded('specialties')),
        ];
    }
}
