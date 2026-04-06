<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class RoleFactory extends Factory {
    public function definition(): array {
        $roleCodeArray = ['admin', 'lawyer', 'secretary'];
        $roleCode = $this->faker->randomElement($roleCodeArray);
        $name = match($roleCode) {
            'admin'     => 'Administrador',
            'lawyer'    => 'Abogado',
            'secretary' => 'Secretario',
        };
        $description = match($roleCode) {
            'admin'     => 'Encargado de toda la gestión y supervisión del sistema',
            'lawyer'    => 'Responsable de los casos legales y la asesoría jurídica',
            'secretary' => 'Apoya en tareas administrativas y organización de documentos',
        };
        return [
            'role_code'   => $roleCode,
            'name'        => $name,
            'description' => $description,
        ];
    }
}