<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class UserFactory extends Factory {
    public function definition(): array {
        $documentType = $this->faker->randomElement(['dni','ce']);
        return [
            'document_type' => $documentType,
            'document_number' => $documentType === 'dni' ? $this->faker->unique()->numerify('########') : $this->faker->unique()->numerify('#########'),
            'names' => $this->faker->firstName(),
            'paternal_surname' => $this->faker->lastName(),
            'maternal_surname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'password',
            'phone' => $this->faker->numerify('9########'),
            'tuition_number' => null,
            'profile_photo' => null,
            'is_active' => $this->faker->randomElement([1,0]),
            'last_login_at' => null,
        ];
    }
}