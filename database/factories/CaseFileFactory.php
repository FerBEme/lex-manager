<?php
namespace Database\Factories;
use App\Models\CaseFile;
use Illuminate\Database\Eloquent\Factories\Factory;
class CaseFileFactory extends Factory {
    public function definition(): array {
        return [
            'case_number' => $this->generateCaseNumber(),
            'judicial_body' => fake()->randomElement(['Juzgado Civil','Juzgado Penal','Juzgado Laboral']),
            'judicial_district' => fake()->randomElement(['Lima','Arequipa','Cusco']),
            'judge' => fake()->name(),
            'legal_specialist' => fake()->name(),
            'start_date' => fake()->dateTimeBetween('-3 years', 'now'),
            'process_type' => fake()->randomElement(['Ordinario','Sumarísimo','Ejecutivo']),
            'specialty' => fake()->randomElement(['Civil','Penal','Laboral']),
            'subject' => fake()->sentence(),
            'status' => fake()->randomElement(['En trámite','Archivado','Concluido']),
            'procedural_stage' => fake()->randomElement(['Inicio','Investigación','Sentencia']),
            'end_date' => fake()->optional()->dateTimeBetween('now', '+1 year'),
            'conclusion_reason' => fake()->optional()->sentence(),
            'location' => fake()->address(),
            'summary' => fake()->paragraph(),
            'customer_id' => null,
            'lawyer_id' => null,
        ];
    }
    private function generateCaseNumber(): string {
        $correlative = str_pad(fake()->numberBetween(1, 99999), 5, '0', STR_PAD_LEFT);
        $year = fake()->numberBetween(2018, now()->year);
        $internal = str_pad(fake()->numberBetween(0, 99), 2, '0', STR_PAD_LEFT);
        $district = fake()->randomElement(['1801','1802','1807','2001']);
        $organ = fake()->randomElement(['JR','JC']);
        $specialty = fake()->randomElement(['CO','PE','LA']);
        $court = str_pad(fake()->numberBetween(1, 20), 2, '0', STR_PAD_LEFT);
        return "{$correlative}-{$year}-{$internal}-{$district}-{$organ}-{$specialty}-{$court}";
    }
}
