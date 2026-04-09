<?php
namespace App\Http\Requests\CaseFile;
use Illuminate\Foundation\Http\FormRequest;
class UpdateCaseFileRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        $caseFile = $this->route('case_file');
        return [
            'file_number' => 'required|max:30|unique:case_files,file_number,' . $caseFile->id,
            'jurisdictional_body' => 'required|max:100',
            'judicial_district' => 'required|max:100',
            'judge' => 'nullable|max:100',
            'legal_specialist' => 'required|max:100',
            'start_date' => 'required|date',
            'process' => 'nullable|max:100',
            'subject' => 'nullable|string',
            'completion_date' => 'nullable|date',
            'specialty_id' => 'required|integer|exists:specialties,id',
            'status_id' => 'required|integer|exists:file_statuses,id',
            'location_id' => 'required|integer|exists:file_locations,id',
            'lawyer_id' => 'required|integer|exists:users,id',
            'customer_id' => 'required|integer|exists:customers,id',
        ];
    }
    public function messages(): array {
        return [
            'file_number.required' => 'Es necesario llenar el campo de Número de Expediente',
            'file_number.max' => 'El campo de Número de Expediente debe tener 30 caracteres como máximo',
            'file_number.unique' => 'Ya existe un Número de Expediente igual en el sistema',
            'jurisdictional_body.required' => 'Es necesario llenar el campo de Órgano Jurisdiccional',
            'jurisdictional_body.max' => 'El campo de Órgano Jurisdiccional debe tener 100 caracteres como máximo',
            'judicial_district.required' => 'Es necesario llenar el campo de Distrito Judicial',
            'judicial_district.max' => 'El campo de Distrito Judicial debe tener 100 caracteres como máximo',
            'judge.max' => 'El campo de Juez(a) debe tener 100 caracteres como máximo',
            'legal_specialist.required' => 'Es necesario llenar el campo de Especialista Legal',
            'legal_specialist.max' => 'El campo de Distrito Judicial debe tener 100 caracteres como máximo',
            'start_date.required' => 'Es necesario llenar el campo de Fecha de Inicio',
            'start_date.date' => 'El campo de Fecha de Inicio debe ser en formato fecha (date)',
            'process.max' => 'El campo de Proceso debe tener 100 caracteres como máximo',
            'completion_date.date' => 'El campo de Fecha de Conclusión debe ser en formato fecha (date)',
            'specialty_id.required' => 'Es necesario llenar el campo de Especialidad Asignado',
            'specialty_id.integer' => 'El campo de Especialidad Asignado debe ser entero',
            'specialty_id.exists' => 'El valor del campo de Especialidad Asignado no existe en el sistema',
            'status_id.required' => 'Es necesario llenar el campo de Estado Asignado',
            'status_id.integer' => 'El campo de Estado Asignado debe ser entero',
            'status_id.exists' => 'El valor del campo de Estado Asignado no existe en el sistema',
            'location_id.required' => 'Es necesario llenar el campo de Localización Asignado',
            'location_id.integer' => 'El campo de Localización Asignado debe ser entero',
            'location_id.exists' => 'El valor del campo de Localización Asignado no existe en el sistema',
            'lawyer_id.required' => 'Es necesario llenar el campo de Abogado Asignado',
            'lawyer_id.integer' => 'El campo de Abogado Asignado debe ser entero',
            'lawyer_id.exists' => 'El valor del campo de Abogado Asignado no existe en el sistema',
            'customer_id.required' => 'Es necesario llenar el campo de Cliente Asignado',
            'customer_id.integer' => 'El campo de Cliente Asignado debe ser entero',
            'customer_id.exists' => 'El valor del campo de Cliente Asignado no existe en el sistema',
        ];
    }
}
