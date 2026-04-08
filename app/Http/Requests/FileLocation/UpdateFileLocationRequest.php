<?php
namespace App\Http\Requests\FileLocation;
use Illuminate\Foundation\Http\FormRequest;
class UpdateFileLocationRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        $fileLocation = $this->route('file_locations');
        return [
            'file_location_code' => 'required|max:50|unique:file_locations,file_location_code,' . $fileLocation,
            'name' => 'required|max:50',
            'description' => 'nullable|string',
        ];
    }
    public function messages(): array {
        return [
            'file_location_code.required' => 'Es necesario llenar el campo de Código de Localización',
            'file_location_code.max' => 'El campo de Código de Localización debe tener máximo 50 caracteres',
            'file_location_code.unique' => 'El campo de Código de Localización ya existe en el Sistema',
            'name.required' => 'Es necesario llenar el campo de Nombre de Localización',
            'name.max' => 'El campo de Nombre de Localización debe tener máximo 50 caracteres',
        ];
    }
}
