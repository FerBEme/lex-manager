<?php
namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;
class RoleSeeder extends Seeder {
    public function run(): void {
        Role::insert([
            ['role_code' => 'admin', 'name' => 'Administrador', 'description' => 'Control total del sistema y gestión de usuarios'],
            ['role_code' => 'lawyer', 'name' => 'Abogado', 'description' => 'Gestión de expedientes, clientes y documentos legales'],
            ['role_code' => 'secretary', 'name' => 'Secretario', 'description' => 'Apoyo administrativo, agenda y registro de información'],
        ]);
    }
}