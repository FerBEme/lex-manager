<?php
namespace Database\Factories;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
class CustomerFactory extends Factory {
    public function definition(): array {
        $documentType = $this->faker->randomElement(['dni','ce','ruc']);
        $nroDocument = match ($documentType) {
            'dni' => fake()->unique()->numerify('########'),
            'ce' => fake()->unique()->numerify('##########'),
            'ruc' => fake()->unique()->numerify('20#########'),
        };
        return [
            'document_type' => $documentType,
            'nro_document' => $nroDocument,
            'company_name' => $documentType === 'ruc' ? fake()->company() : null,
            'first_name' => $documentType !== 'ruc' ? fake()->firstName() : null,
            'paternal_name' => $documentType !== 'ruc' ? fake()->lastName() : null,
            'maternal_name' => $documentType !== 'ruc' ? fake()->lastName() : null,
            'phone' => fake()->numerify('9########'),
            'email' => fake()->optional()->safeEmail(),
            'address' => fake()->address(),
        ];
    }
}
