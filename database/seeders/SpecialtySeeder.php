<?php
namespace Database\Seeders;
use App\Models\Specialty;
use Illuminate\Database\Seeder;
class SpecialtySeeder extends Seeder {
    public function run(): void {
        Specialty::insert([
            [
                'specialty_code' => 'civil',
                'name'           => 'Derecho Civil',
                'description'    => 'Asuntos de contratos, obligaciones, propiedad, indemnizaciones y conflictos entre particulares.',
            ],
            [
                'specialty_code' => 'criminal',
                'name'           => 'Derecho Penal',
                'description'    => 'Defensa y representación en delitos, denuncias, investigaciones y procesos penales.',
            ],
            [
                'specialty_code' => 'laboral',
                'name'           => 'Derecho Laboral',
                'description'    => 'Casos de despidos, beneficios sociales, contratos de trabajo y conflictos laborales.',
            ],
            [
                'specialty_code' => 'familia',
                'name'           => 'Derecho de Familia',
                'description'    => 'Divorcios, alimentos, tenencia, sucesiones y violencia familiar.',
            ],
            [
                'specialty_code' => 'comercial',
                'name'           => 'Derecho Comercial y Empresarial',
                'description'    => 'Constitución de empresas, contratos comerciales y asesoría societaria.',
            ],
            [
                'specialty_code' => 'propiedad',
                'name'           => 'Derecho Inmobiliario',
                'description'    => 'Compra, venta, saneamiento, posesión y regularización de inmuebles.',
            ],
            [
                'specialty_code' => 'notarial',
                'name'           => 'Derecho Notarial y Registral',
                'description'    => 'Trámites notariales, registros públicos, escrituras y formalización.',
            ],
            [
                'specialty_code' => 'administrativo',
                'name'           => 'Derecho Administrativo',
                'description'    => 'Procedimientos ante municipalidades, entidades públicas y sanciones administrativas.',
            ],
            [
                'specialty_code' => 'constitucional',
                'name'           => 'Derecho Constitucional',
                'description'    => 'Procesos de amparo, hábeas corpus y protección de derechos fundamentales.',
            ],
            [
                'specialty_code' => 'tributario',
                'name'           => 'Derecho Tributario',
                'description'    => 'Asesoría sobre impuestos, SUNAT, fiscalizaciones y reclamaciones tributarias.',
            ],
            [
                'specialty_code' => 'migratorio',
                'name'           => 'Derecho Migratorio',
                'description'    => 'Trámites de residencia, nacionalidad, visas y extranjería.',
            ],
            [
                'specialty_code' => 'consumidor',
                'name'           => 'Protección al Consumidor',
                'description'    => 'Reclamos ante INDECOPI, publicidad engañosa y derechos del consumidor.',
            ],
        ]);
    }
}