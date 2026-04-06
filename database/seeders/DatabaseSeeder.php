<?php
namespace Database\Seeders;

use App\Models\Customer;
use App\Models\FileStatus;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Specialty;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
    public function run(): void {
        $roles = [
            [
                'role_code' => 'admin',
                'name' => 'Administrador',
                'description' => 'Encargado de toda la gestión y supervisión del sistema',
            ],
            [
                'role_code' => 'lawyer',
                'name' => 'Abogado',
                'description' => 'Responsable de los casos legales y la asesoría jurídica',
            ],
            [
                'role_code' => 'secretary',
                'name' => 'Secretario',
                'description' => 'Apoya en tareas administrativas y organización de documentos',
            ]
        ];
        foreach ($roles as $value) {
            Role::create([
                'role_code' => $value['role_code'],
                'name' => $value['name'],
                'description' => $value['description'],
            ]);
        }
        $specialties = [
            [
                'specialty_code' => 'FAMILIA CIVIL',
                'description' => 'El Derecho de Familia regula las relaciones y responsabilidades entre los miembros de una familia, abarcando aspectos como matrimonio, divorcio, custodia de hijos y pensiones alimenticias. Por su parte, el Derecho Civil se encarga de las relaciones entre las personas y los bienes, incluyendo la regulación de contratos, propiedad, herencias y responsabilidad por daños',
            ],
            [
                'specialty_code' => 'CIVIL',
                'description' => 'El Derecho Civil es la rama del derecho que regula las relaciones entre las personas y los bienes, abarcando aspectos como contratos, propiedad, herencias, obligaciones y responsabilidad por daños',
            ]
        ];
        foreach ($specialties as $value) {
            Specialty::create([
                'specialty_code' => $value['specialty_code'],
                'description' => $value['description'],
            ]);
        }
        Customer::factory(20)->create();
        $permissions = [
            ['permission_code' => 'roles.index','description' => 'Permiso para ver los roles del Sistema'],
            ['permission_code' => 'roles.store','description' => 'Permiso para crear mas roles del Sistema'],
            ['permission_code' => 'roles.show','description' => 'Permiso para ver un rol especifico del Sistema'],
            ['permission_code' => 'roles.update','description' => 'Permiso para actualizar un rol específico del Sistema'],
            ['permission_code' => 'roles.create','description' => 'Permiso para eliminar un rol específico del Sistema']
        ];
        foreach ($permissions as $value) {
            Permission::create([
                'permission_code' => $value['permission_code'],
                'description' => $value['description'],
            ]);
        }
        $fileStatus = [
            ['file_status_code' => 'PENDIENTE','description' => 'El expediente esta pendiente'],
            ['file_status_code' => 'ARCHIVADO','description' => 'El expediente fue archivado'],
        ];
        foreach ($fileStatus as $value) {
            FileStatus::create([
                'file_status_code' => $value['file_status_code'],
                'description' => $value['description'],
            ]);
        }
    }
}
