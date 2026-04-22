<?php
namespace Database\Factories;
use App\Models\CaseFile;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
class FolderFactory extends Factory {
    protected $model = Folder::class;
    public function definition(): array {
        return [
            'name' => fake()->word() . '-' . fake()->unique()->numberBetween(1,10000),
            'parent_id' => null,
            'case_id' => CaseFile::inRandomOrder()->first()?->id,
            'created_by' => User::inRandomOrder()->first()?->id,
        ];
    }
    public function child($parentId = null): static {
        return $this->state(fn() => [
            'parent_id' => $parentId ?? Folder::inRandomOrder()->first()->id,
        ]);
    }
    public function root(): static {
        return $this->state(fn() => [
            'parent_id' => null,
        ]);
    }
}