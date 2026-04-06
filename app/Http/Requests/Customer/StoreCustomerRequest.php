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
            'document_number' => 'required|max_digits:11|unique:customers,document_number',
            'company_name' => 'nullable|max:50',
            'names' => 'nullable|string',
            'paternal_surname' => 'nullable|string',
            'maternal_surname' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|digits:9',
            'home_address' => 'nullable|string',
        ];
    }
    public function messages():array {
        return [
            'document_type.required' => 'Es necesario escoger el campo de Tipo de Documento',
            'document_type.in' => 'Tienes que escoger las opciones de "dni", "ce" o "ruc"',
            'document_number.required' => 'Es necesario llenar el campo de Número de Documento',
            'document_number.max_digits' => 'Debe tener 11 digitos como máximo el campo  de Número de Documento y ser numéricos',
            'document_number.unique' => 'Es Número de Documento ya existe en el sistema',
            'email.email' => 'El campo de Correo Electrónico debe se con @',
            'phone.digits' => 'Es campo de Número Telefónico debe ser de 9 dítigos numéricos',
        ];
    }
}