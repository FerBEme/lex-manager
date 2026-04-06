<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class CustomerFactory extends Factory {
    public function definition(): array {
        $documentType = $this->faker->randomElement(['dni','ce','ruc']);
        $documentNumber = match($documentType) {
            'dni' => $this->faker->unique()->numerify('########'),
            'ce'  => $this->faker->unique()->numerify('#########'),
            'ruc' => $this->faker->unique()->numerify('10#########'),
        };
        return [
            'document_type'    => $documentType,
            'document_number'  => $documentNumber,
            'company_name'     => $documentType === 'ruc' ? $this->faker->company() : null,
            'names'            => $documentType !== 'ruc' ? $this->faker->firstName()  : null,
            'paternal_surname' => $documentType !== 'ruc' ? $this->faker->lastName()  : null,
            'maternal_surname' => $documentType !== 'ruc' ? $this->faker->lastName()  : null,
            'email'            => $this->faker->safeEmail(),
            'phone'            => $this->faker->numerify('9########'),
            'home_address'     => $this->faker->address(),
        ];
    }
}