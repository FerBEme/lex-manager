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
            'case_number' => 'required|unique:case_files,case_number,' . $caseFile->id,
            'judicial_body' => 'nullable',
            'judicial_district' => 'nullable',
            'judge' => 'nullable',
            'legal_specialist' => 'nullable',
            'start_date' => 'required|date',
            'process_type' => 'nullable',
            'specialty' => 'nullable',
            'subject' => 'nullable',
            'status' => 'nullable|max:100',
            'procedural_stage' => 'nullable|max:100',
            'end_date' => 'nullable|date',
            'conclusion_reason' => 'nullable',
            'location' => 'nullable',
            'summary' => 'nullable',
            'customer_id' => 'required|exists:customers,id',
            'lawyer_id' => 'required|exists:users,id',
        ];
    }
    public function messages():array{
        return [
            'case_number.required' => 'Es necesario llenar el campo de Número de Expediente',
            'case_number.unique' => 'Ya existe un valor como el campo de Número de Expediente en el sistema',
            'start_date.required' => 'Es necesario llenar el campo de Fecha de Inicio',
            'start_date.date' => 'El campo de Fecha de Inicio debe ser formato fecha',
            'status.max' => 'El campo de Estado de Expediente debe tener máximo 100 caracteres',
            'procedural_stage.max' => 'El campo de Etapa Procesal del Expediente debe tener máximo 100 caracteres',
            'end_date.date' => 'El campo de Fecha de Conclusión debe ser formato fecha',
            'customer_id.required' => 'Es necesario llenar el campo de Cliente Asignado',
            'customer_id.exists' => 'El campo de Cliente Asignado debe existir en el sistema',
            'lawyer_id.required' => 'Es necesario llenar el campo de Abogado Asignado',
            'lawyer_id.exists' => 'El campo de Abogado Asignado debe existir en el sistema',
        ];
    }
}