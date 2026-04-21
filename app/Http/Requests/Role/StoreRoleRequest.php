<?php
namespace App\Http\Requests\Role;
use Illuminate\Foundation\Http\FormRequest;
class StoreRoleRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        return [
            'name' => 'required|max:50|unique:roles,name'
        ];
    }
    public function messages(): array{
        return [
            'name.required' => 'Es necesario rellenar este campo de Nombre de Rol',
            'name.max' => 'El campo de Nombre de Rol debe tener máximo 50 caracteres',
            'name.unique' => 'Ya existe en el sistema un valor como el campo de Nombre de Rol',
        ];
    }
}