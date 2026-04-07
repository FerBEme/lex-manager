<?php
namespace Database\Seeders;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
class RoleSeeder extends Seeder {
    public function run(): void {
        $roles = [
            ['role_code' => 'admin', 'name' => 'Administrador', 'description' => 'Control total del sistema y gestión de usuarios'],
            ['role_code' => 'lawyer', 'name' => 'Abogado', 'description' => 'Gestión de expedientes, clientes y documentos legales'],
            ['role_code' => 'secretary', 'name' => 'Secretario', 'description' => 'Apoyo administrativo, agenda y registro de información'],
        ];
        foreach ($roles as $roleData) {
            $role = Role::create([
                'role_code' => $roleData['role_code'],
                'name' => $roleData['name'],
                'description' => $roleData['description'],
            ]);
            if ($role->role_code === 'admin') {
                $permissions = Permission::all()->pluck('id')->toArray();
                $role->permissions()->sync($permissions);
            }
        }
    }
}