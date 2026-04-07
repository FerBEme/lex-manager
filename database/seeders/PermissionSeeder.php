<?php
namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
class PermissionSeeder extends Seeder {
    public function run(): void {
        Permission::insert([
            ['permission_code' => 'roles.index','description' => 'Permiso para ver los roles del Sistema'],
            ['permission_code' => 'roles.store','description' => 'Permiso para crear mas roles del Sistema'],
            ['permission_code' => 'roles.show','description' => 'Permiso para ver un rol especifico del Sistema'],
            ['permission_code' => 'roles.update','description' => 'Permiso para actualizar un rol específico del Sistema'],
            ['permission_code' => 'roles.create','description' => 'Permiso para eliminar un rol específico del Sistema']
        ]);
    }
}
