<?php
namespace App\Http\Requests\File;
use Illuminate\Foundation\Http\FormRequest;
class UpdateFileRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        return [
            'file_name' => 'sometimes|string|max:255',
            'file_path' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240',
        ];
    }
    public function messages(): array {
        return [
            'file_name.string' => 'El Nombre de Archivo debe ser texto válido',
            'file_name.max' => 'El Nombre de Archivo debe tener máximo 255 caracteres',
            'file_path.required' => 'Debes subir un nuevo archivo',
            'file_path.file' => 'El archivo subido no es válido',
            'file_path.mimes' => 'El archivo debe ser de tipo: pdf, doc, docx, jpg o png',
            'file_path.max' => 'El archivo no debe superar los 10MB',
        ];
    }
}