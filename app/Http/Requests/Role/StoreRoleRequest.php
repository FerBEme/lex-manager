<?php
namespace App\Http\Requests\Role;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
class StoreRoleRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        return [
            'role_code' => 'required|max:50|unique:roles,role_code',
            'name' => 'required|string',
            'description' => 'nullable|string',
        ];
    }
    public function messages(): array {
        return [
            'role_code.required' => 'Es necesario llenar el campo de Codigo de Rol',
            'role_code.max' => 'Máximo 50 caracteres',
            'role_code.unique' => 'Este codigo de rol ya existe',
            'name.required' => 'Es obligatorio llenar el campo de Nombre',
        ];
    }
}
