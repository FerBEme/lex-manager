<?php
namespace Database\Factories;

use App\Models\CaseFile;
use Illuminate\Database\Eloquent\Factories\Factory;
class PaymentFactory extends Factory {
    public function definition(): array {
        $type = $this->faker->randomElement([
            'expense',
            'free',
            'advance'
        ]);
        $descriptions = [
            'expense' => [
                'Pago de tasas judiciales',
                'Gasto por movilidad al juzgado',
                'Pago de copias certificadas',
                'Gasto de notificación notarial',
            ],
            'free' => [
                'Honorarios profesionales por patrocinio',
                'Pago por elaboración de demanda',
                'Honorarios por audiencia judicial',
                'Pago mensual por asesoría legal',
            ],
            'advance' => [
                'Adelanto de honorarios',
                'Pago anticipado por trámite',
                'Entrega inicial para gastos judiciales',
                'Adelanto por servicio legal',
            ],
        ];
        return [
            'type' => $type,
            'amount' => fake()->randomFloat(
                2,
                match ($type) {
                    'expense' => 20,
                    'advance' => 100,
                    'free' => 300,
                },
                match ($type) {
                    'expense' => 500,
                    'advance' => 1500,
                    'free' => 5000,
                },
            ),
            'status' => fake()->randomElement(['pending','partial','paid']),
            'description' => fake()->randomElement($descriptions[$type]),
            'case_file_id' => CaseFile::all()->random()->id,
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
