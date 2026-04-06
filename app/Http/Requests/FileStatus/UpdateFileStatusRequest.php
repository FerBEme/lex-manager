<?php
namespace App\Http\Requests\FileStatus;
use Illuminate\Foundation\Http\FormRequest;
class UpdateFileStatusRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        $fileStatus = $this->route('file_status');
        return [
            'file_status_code' => 'required|max:50|unique:file_statuses,file_status_code,' . $fileStatus->id,
            'description' => 'nullable|string',
        ];
    }
    public function messages(): array {
        return [
            'file_status_code.required' => 'Es obligatorio llenar este campo de Codigo de estado del Expediente',
            'file_status_code.max' => 'El Código del estado de Expediente debe tener máximo 50 caracteres',
            'file_status_code.unique' => 'El Código del estado de Expediente ya existe en el sistema',
        ];
    }
}
