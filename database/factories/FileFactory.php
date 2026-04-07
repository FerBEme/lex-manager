<?php
namespace Database\Factories;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
class FileFactory extends Factory {
    public function definition(): array {
        $extensions = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls'  => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'zip' => 'application/zip',
        ];
        $fileType = $this->faker->randomElement(array_keys($extensions));
        $baseName = $this->faker->slug();
        return [
            'name' => $baseName . '.' . $fileType,
            'original_name' => $this->faker->words(3,true) . '.' . $fileType,
            'file_type' => $fileType,
            'mime_type' => $extensions[$fileType],
            'file_size' => $this->faker->numberBetween(50_000, 15_000_000),
            'storage_path' => 'uploads/files/' . $this->faker->uuid() . '.' . $fileType,
            'folder_id' => Folder::all()->random()->id,
            'uploaded_by' => User::all()->random()->id,
        ];
    }
}