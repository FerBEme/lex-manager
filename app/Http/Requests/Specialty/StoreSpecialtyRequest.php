<?php
namespace App\Http\Requests\Specialty;
use Illuminate\Foundation\Http\FormRequest;
class StoreSpecialtyRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        return [
            'specialty_code' => 'required|max:50|unique:specialties,specialty_code',
            'description' => 'nullable|string',
        ];
    }
    public function messages(): array {
        return [
            'specialty_code.required' => 'Es necesario llenar el campo de Código de Especialidad',
            'specialty_code.max' => 'El campo de Código de Especialidad no debe pasar de 50 caracteres',
            'specialty_code.unique' => 'Ya existe un Código de Especialidad con ese nombre',
        ];
    }
}