<?php
namespace App\Http\Requests\Customer;
use Illuminate\Foundation\Http\FormRequest;
class StoreCustomerRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        return [
            'document_type' => 'required|in:dni,ce,ruc',
            'nro_document' => 'required|max:12|unique:customers,nro_document',
            'company_name' => 'nullable',
            'first_name' => 'nullable',
            'paternal_name' => 'nullable',
            'maternal_name' => 'nullable',
            'phone' => 'required|digits:9',
            'email' => 'nullable',
            'address' => 'required'
        ];
    }
    public function messages():array{
        return [
            'document_type.required' => 'Es necesario completar el campo de Tipo de Documento',
            'document_type.in' => 'El campo de Tipo de Documento debe tener estos valores ("dni","ce","ruc")',
            'nro_document.required' => 'Es necesario completar el campo de Número de Documento',
            'nro_document.max' => 'El campo de Número de Documento debe tener máximo 12 digitos',
            'nro_document.unique' => 'El valor del campo de Número de Documento ya existe en el sistema',
            'phone.required' => 'Es necesario completar el campo de Celular',
            'phone.digits' => 'El campo de Celular debe tener 9 dígitos',
            'address.required' => 'Es necesario completar el campo de Dirección',
        ];
    }
}