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
            'document_number' => 'required|max_digits:9|unique:users,document_number',
            'names' => 'required|string',
            'paternal_surname' => 'required|string',
            'maternal_surname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'nullable|digits:9',
            'lawyer_id' => 'nullable|integer|exists:users,id',
            'tuition_number' => 'nullable|digits:5|unique:users,tuition_number',
            'profile_photo' => 'nullable|image',
            'is_active' => 'nullable|integer',
            'last_login_at' => 'nullable|datetime',
            'role' => 'required|array|min:1',
            'role.*' => 'integer|exists:roles,id',
            'specialty' => 'nullable|array',
            'specialty.*' => 'nullable|integer|exists:specialties,id',
        ];
    }
    public function messages(): array {
        return [
            'document_type.required' => 'Es necesario escoger una opción de Tipo de Documento',
            'document_type.in' => 'El valor del campo debe ser "dni" o "ce"',
            'document_number.required' => 'Es necesario llenar el campo de Número de Documento',
            'document_number.max_digits' => 'Es campo de número de Documento solo puede tener máximo 9 digitos',
            'document_number.unique' => 'Ya existe un registro con ese Número de Documento',
            'names.required' => 'Es necesario llenar el campo de Nombres',
            'paternal_surname.required' => 'Es necesario llenar el campo de Apellido Paterno',
            'maternal_surname.required' => 'Es necesario llenar el campo de Apellido Materno',
            'email.required' => 'Es necesario llenar el campo de Correo Electrónico',
            'email.email' => 'Ese datos no se consdiera como un Correo Electrónico',
            'email.unique' => 'Ya existe un registro con ese Correo Electrónico',
            'password.required' => 'Es necesario llenar el campo de Contraseña',
            'phone.digits' => 'El campo de Telefono debe tener solo 9 caracteres, ni mas ni menos',
            'lawyer_id.integer' => 'El campo de Abogado Asignado debe ser entero',
            'lawyer_id.exists' => 'No existe ese Abogado en el sistema',
            'tuition_number.digits' => 'El campo de Numero de Colegiatura debe tener 5 digitos ni mas ni menos',
            'tuition_number.unique' => 'Ya existe un registro con ese Número de Colegiatura',
            'profile_photo.image' => 'Este campo debe ser de Archivo imagen jpg, jpeg, png',
            'is_active.integer' => 'El campo de ACtividad debe ser (1: activo, 0: inactivo)',
            'last_login_at.datetime' => 'Este campo debe ser formato Fecha Hora',
            'role.required' => 'Es necesario escoger una opción de Roles',
            'role.array' => 'El campo de Roles debe ser un arreglo',
            'role.*.exists' => 'Uno de los Roles seleccionados no existe',
            'specialty.array' => 'El campo de Especialidades debe ser un arreglo',
            'specialty.*.exists' => 'Una de las Especialidades seleccionadas no existe',
        ];
    }
}
