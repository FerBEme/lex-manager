<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
class TemplateFactory extends Factory {
    public function definition(): array {
        $templateNames = [
            'Contrato de Arrendamiento',
            'Carta Notarial',
            'Poder Simple',
            'Demanda de Alimentos',
            'Contrato de Compra Venta',
            'Acta de Conciliación',
            'Solicitud de Prescripción Adquisitiva',
            'Modelo de Recurso de Apelación',
        ];
        return [
            'name' => fake()->randomElement($templateNames),
            'content' => fake()->paragraph(rand(3,8),true),
            'logo_path' => fake()->boolean(70) ? 'logos/' . fake()->uuid() . '.png' : null,
            'created_by' => User::all()->random()->id,
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
