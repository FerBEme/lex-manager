<?php
namespace App\Http\Requests\Permission;
use Illuminate\Foundation\Http\FormRequest;
class UpdatePermissionRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        $permission = $this->route('permission');
        return [
            'permission_code' => 'required|max:50|unique:permissions,permission_code,' . $permission->id,
            'description' => 'nullable|string',
        ];
    }
    public function messages(): array {
        return [
            'permission_code.required' => 'Es necesario que complete el campo de Código de Permiso',
            'permission_code.max' => 'El campo Código de Permiso debe tener máximo 50 caracteres',
            'permission_code.unique' => 'Ya existe el nombre del campo de Código de Permiso en el Sistema',
        ];
    }
}
