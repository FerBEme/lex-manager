<?php
namespace Database\Factories;
use App\Models\File;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
class FileFactory extends Factory {
    protected $model = File::class;
    public function definition(): array {
        return [
            'file_name' => $this->faker->word() . '.' . $this->faker->fileExtension(),
            'file_path' => 'files/' . $this->faker->uuid() . '.' . $this->faker->fileExtension(),
            'file_type' => $this->faker->randomElement(['pdf', 'docx', 'xlsx', 'jpg', 'png']),
            'version' => $this->faker->numberBetween(1, 5),
            'folder_id' => Folder::inRandomOrder()->first()->id ?? Folder::factory(),
            'uploaded_by' => User::inRandomOrder()->first()->id ?? User::factory(),
        ];
    }
}