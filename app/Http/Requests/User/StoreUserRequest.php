<?php
namespace App\Http\Requests\User;
use Illuminate\Foundation\Http\FormRequest;
class StoreUserRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        return [
            'document_type' => 'required|in:dni,ce',
            'nro_document' => 'required|max:12|unique:users,nro_document',
            'first_name' => 'required',
            'paternal_name' => 'required',
            'maternal_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'nullable|digits:9',
            'register_cal' => 'nullable|max:5',
            'profile_photo' => 'nullable|image',
            'is_active' => 'nullable|integer',
            'role_id' => 'required|integer|exists:roles,id',
            'lawyer_id' => 'nullable|integer|exists:users,id',
        ];
    }
    public function messages():array{
        return [
            'document_type.required' => 'Es necesario llenar el campo de Tipo de Documento',
            'document_type.in' => 'El campo de Tipo de Documento debe ser ("dni" o "ce")',
            'nro_document.required' => 'Es necesario llenar el campo de Número de Documento',
            'nro_document.max' => 'El campo de Número de Documento debe tener máximo 12 caracteres',
            'nro_document.unique' => 'El valor del campo de Número de Documento ya existe en el sistema',
            'first_name.required' => 'Es necesario llenar el campo de Nombres',
            'paternal_name.required' => 'Es necesario llenar el campo de Apellido Paterno',
            'maternal_name.required' => 'Es necesario llenar el campo de Apellido Materno',
            'email.required' => 'Es necesario llenar el campo de Correo Electrónico',
            'email.email' => 'El campo de Correo Electrónico debe ser un formato de Email',
            'email.unique' => 'El valor del campo de Correo Electrónico ya existe en el sistema',
            'password.required' => 'Es necesario llenar el campo de Contraseña',
            'password.min' => 'El campo de Contraseña debe tener mínimo 6 caracteres',
            'phone.digits' => 'El campo de celular debe tener 9 dígitos',
            'register_cal.max' => 'El campo de Colegio de Abogado debe tener máximo 5 dígitos',
            'profile_photo.image' => 'El campo de Foto de Perfil debe ser un archivo de imagen jpg, png',
            'is_active,integer' => 'Este campo si está Activo debe ser entero',
            'role_id.required' => 'Es necesario llenar el campo de Role Asignado',
            'role_id.integer' => 'El campo de Role Asignado debe ser un número entero',
            'role_id.exists' => 'El campo de Role Asignado debe existir en el sistema',
            'lawyer_id.integer' => 'El campo de Abogado Asignado debe ser un número entero',
            'lawyer_id.exists' => 'El campo de Abogado Asignado debe existir en el sistema',
        ];
    }
}
