<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class RoleResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'código_rol' => $this->role_code,
            'nombre' => $this->name,
            'descripción' => $this->description,
            'permisos' => PermissionResource::collection($this->whenLoaded('permissions')),
            'usuarios' => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}