<?php
namespace App\Http\Requests\Login;
use Illuminate\Foundation\Http\FormRequest;
class LoginRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];
    }
    public function messages(): array {
        return [
            'email.required' => 'Es necesario llenar este campo de Correo Electrónico',
            'email.email' => 'Debe ser un formato de Correo Electrónico',
            'password.required' => 'Es necesario llenar este campo de Contraseña',
            'password.min' => 'Muy corto para ser una contraseña',
        ];
    }
}
