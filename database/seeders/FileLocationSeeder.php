<?php
namespace Database\Seeders;
use App\Models\FileLocation;
use Illuminate\Database\Seeder;
class FileLocationSeeder extends Seeder {
    public function run(): void {
        FileLocation::insert([
            [
                'file_location_code' => 'physical_archive',
                'name'               => 'Archivo Físico',
                'description'        => 'Documentos almacenados en archivadores o estanterías dentro de la oficina.',
            ],
            [
                'file_location_code' => 'digital_server',
                'name'               => 'Servidor Digital',
                'description'        => 'Documentos almacenados digitalmente en el servidor principal del sistema.',
            ],
            [
                'file_location_code' => 'google_drive',
                'name'               => 'Google Drive',
                'description'        => 'Documentos respaldados o compartidos mediante Google Drive.',
            ],
            [
                'file_location_code' => 'onedrive',
                'name'               => 'OneDrive',
                'description'        => 'Archivos almacenados en la nube mediante OneDrive.',
            ],
            [
                'file_location_code' => 'client_delivered',
                'name'               => 'Entregado al Cliente',
                'description'        => 'Documentación física o digital que ya fue entregada al cliente.',
            ],
            [
                'file_location_code' => 'lawyer_office',
                'name'               => 'Oficina del Abogado',
                'description'        => 'Expedientes o documentos actualmente bajo resguardo del abogado.',
            ],
            [
                'file_location_code' => 'secretary_desk',
                'name'               => 'Escritorio de Secretaría',
                'description'        => 'Documentos temporales en proceso de revisión o registro por secretaría.',
            ],
            [
                'file_location_code' => 'notary_office',
                'name'               => 'Notaría',
                'description'        => 'Documentación enviada o pendiente en una notaría.',
            ],
            [
                'file_location_code' => 'public_registry',
                'name'               => 'Registros Públicos',
                'description'        => 'Documentos presentados o archivados en registros públicos.',
            ],
            [
                'file_location_code' => 'court',
                'name'               => 'Juzgado',
                'description'        => 'Expedientes o documentos que se encuentran en un juzgado o entidad judicial.',
            ],
        ]);
    }
}