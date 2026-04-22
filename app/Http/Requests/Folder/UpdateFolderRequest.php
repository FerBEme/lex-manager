<?php
namespace App\Http\Requests\Folder;
use Illuminate\Foundation\Http\FormRequest;
class UpdateFolderRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        return [
            'name' => 'sometimes|required|string|max:255',
            'parent_id' => 'nullable|integer|exists:folders,id',
            'case_id' => 'sometimes|integer|exists:case_files,id',
        ];
    }
    public function messages():array {
        return [
            'name.required' => 'Es necesario completar el campo de Nombre de Carpeta',
            'name.string' => 'El nombre de la carpeta debe ser texto',
            'name.max' => 'El nombre de la carpeta no debe exceder los 255 caracteres',
            'parent_id.integer' => 'El campo de Carpeta Asignada debe ser entero',
            'parent_id.exists' => 'El campo de Carpeta Asignada debe existir en el sistema',
            'case_id.integer' => 'El campo de Expediente Asignado debe ser entero',
            'case_id.exists' => 'El campo de Expediente Asignado debe existir en el sistema',
        ];
    }
}