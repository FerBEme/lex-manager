<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class UserFactory extends Factory {
    public function definition(): array {
        $documentType = $this->faker->randomElement(['dni','ce']);
        $numDocument = match ($documentType) {
            'dni' => fake()->unique()->numerify('########'),
            'ce' => fake()->unique()->numerify('############'),
        };
        return [
            'document_type' => $documentType,
            'nro_document' => $numDocument,
            'first_name' => fake()->firstName(),
            'paternal_name' => fake()->lastName(),
            'maternal_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'phone' => fake()->optional()->numerify('9########'),
            'register_cal' => fake()->numerify('#####'),
            'profile_photo' => null,
            'is_active' => fake()->boolean(50),
            'role_id' => null,
            'lawyer_id' => null,
        ];
    }
}