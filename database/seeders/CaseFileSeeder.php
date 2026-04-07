<?php

namespace Database\Seeders;

use App\Models\CaseFile;
use App\Models\Customer;
use App\Models\FileLocation;
use App\Models\FileStatus;
use App\Models\Role;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Seeder;

class CaseFileSeeder extends Seeder
{
    public function run(): void
    {
        $caseFiles = [
            [
                'file_number' => '01452-2023-0-1801-JR-CI-01',
                'jurisdictional_body' => 'Primer Juzgado Civil de Lima',
                'judicial_district' => 'Lima',
                'judge' => 'Dr. Carlos Alberto Ramírez Torres',
                'legal_specialist' => 'María Fernanda Salazar Vega',
                'start_date' => '2023-03-14',
                'process' => 'Proceso de Obligación de Dar Suma de Dinero',
                'subject' => 'Cobro de deuda derivada de contrato de préstamo por S/ 85,000',
                'completion_date' => '2024-01-22',
                'reason_conclusion' => 'Sentencia firme favorable al demandante',
            ],
            [
                'file_number' => '00871-2022-0-0401-JR-FC-02',
                'jurisdictional_body' => 'Segundo Juzgado de Familia de Arequipa',
                'judicial_district' => 'Arequipa',
                'judge' => 'Dra. Patricia Elena Gutiérrez Flores',
                'legal_specialist' => 'José Luis Mendoza Huamán',
                'start_date' => '2022-08-05',
                'process' => 'Proceso de Alimentos',
                'subject' => 'Demanda de aumento de pensión de alimentos para menor de edad',
                'completion_date' => '2023-06-18',
                'reason_conclusion' => 'Conciliación judicial entre las partes',
            ],
            [
                'file_number' => '02134-2021-0-1301-JR-PE-03',
                'jurisdictional_body' => 'Tercer Juzgado Penal Unipersonal de Trujillo',
                'judicial_district' => 'Trujillo',
                'judge' => 'Dr. Julio César Rojas Castillo',
                'legal_specialist' => 'Ana Lucía Paredes Silva',
                'start_date' => '2021-11-10',
                'process' => 'Proceso Penal',
                'subject' => 'Delito de hurto agravado en establecimiento comercial',
                'completion_date' => '2023-02-27',
                'reason_conclusion' => 'Sentencia condenatoria consentida',
            ],
            [
                'file_number' => '00567-2024-0-1501-JR-LA-01',
                'jurisdictional_body' => 'Primer Juzgado Laboral de Huancayo',
                'judicial_district' => 'Huancayo',
                'judge' => 'Dra. Verónica Isabel Peña Ramos',
                'legal_specialist' => 'Ricardo Alberto Cárdenas Soto',
                'start_date' => '2024-01-15',
                'process' => 'Proceso Laboral Ordinario',
                'subject' => 'Reposición por despido arbitrario y pago de beneficios sociales',
                'completion_date' => '2025-02-10',
                'reason_conclusion' => 'Acuerdo conciliatorio homologado',
            ],
            [
                'file_number' => '01789-2023-0-0701-JR-CI-04',
                'jurisdictional_body' => 'Cuarto Juzgado Civil del Callao',
                'judicial_district' => 'Callao',
                'judge' => 'Dr. Miguel Ángel Herrera Lozano',
                'legal_specialist' => 'Sofía Beatriz Navarro Díaz',
                'start_date' => '2023-05-09',
                'process' => 'Proceso de Prescripción Adquisitiva',
                'subject' => 'Solicitud de prescripción adquisitiva de inmueble urbano',
                'completion_date' => '2024-09-03',
                'reason_conclusion' => 'Sentencia declarando fundada la demanda',
            ],
        ];

        $specialties = Specialty::all();
        $statuses = FileStatus::all();
        $locations = FileLocation::all();
        $customers = Customer::all();
        $lawyerRole = Role::where('role_code', 'lawyer')->first();
        $lawyers = User::whereHas('roles', function ($query) use ($lawyerRole) {
            $query->where('roles.id', $lawyerRole->id);
        })->get();
        foreach ($caseFiles as $caseFile) {
            CaseFile::create([
                'file_number' => $caseFile['file_number'],
                'jurisdictional_body' => $caseFile['jurisdictional_body'],
                'judicial_district' => $caseFile['judicial_district'],
                'judge' => $caseFile['judge'],
                'legal_specialist' => $caseFile['legal_specialist'],
                'start_date' => $caseFile['start_date'],
                'process' => $caseFile['process'],
                'subject' => $caseFile['subject'],
                'completion_date' => $caseFile['completion_date'],
                'reason_conclusion' => $caseFile['reason_conclusion'],
                'specialty_id' => $specialties->random()->id,
                'status_id' => $statuses->random()->id,
                'location_id' => $locations->random()->id,
                'lawyer_id' => $lawyers->random()->id,
                'customer_id' => $customers->random()->id,
            ]);
        }
    }
}