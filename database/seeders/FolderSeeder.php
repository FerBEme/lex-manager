<?php
namespace Database\Seeders;
use App\Models\CaseFile;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Database\Seeder;
class FolderSeeder extends Seeder {
    public function run(): void {
        $caseFiles = CaseFile::all();
        $users = User::all();
        for ($i=1; $i <= 8 ; $i++) { 
            Folder::factory()->create([
                'case_file_id' => $caseFiles->random()->id,
                'parent_folder_id' => null,
                'created_by' => $users->random()->id,
            ]);
        }
        $folders = Folder::all();
        for ($i=1; $i < 15; $i++) { 
            Folder::factory()->create([
                'case_file_id' => $caseFiles->random()->id,
                'parent_folder_id' => $folders->random()->id,
                'created_by' => $users->random()->id,
            ]);
        }
    }
}
