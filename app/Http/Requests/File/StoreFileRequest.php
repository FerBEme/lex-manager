<?php
namespace App\Http\Requests\File;
use Illuminate\Foundation\Http\FormRequest;
class StoreFileRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        return [
            'file_name' => 'required|string|max:255',
            'file_path' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240',
            'version' => 'nullable|integer|min:1',
            'folder_id' => 'required|integer|exists:folders,id',
        ];
    }
    public function messages():array{
        return [
            'file_name.required' => 'Es necesario completar el campo Nombre de Archivo',
            'file_name.string' => 'El Nombre de Archivo debe ser texto válido',
            'file_name.max' => 'El Nombre de Archivo debe tener máximo 255 caracteres',
            'file_path.required' => 'Debes seleccionar un archivo',
            'file_path.file' => 'El archivo subido no es válido',
            'file_path.mimes' => 'El archivo debe ser de tipo: pdf, doc, docx, jpg o png',
            'file_path.max' => 'El archivo no debe superar los 10MB',
            'version.integer' => 'La Versión debe ser un número entero',
            'version.min' => 'La Versión debe ser mínimo 1',
            'folder_id.required' => 'Debes seleccionar un folder',
            'folder_id.integer' => 'El Folder debe ser un número válido',
            'folder_id.exists' => 'El Folder seleccionado no existe en el sistema',
        ];
    }
}