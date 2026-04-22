<?php
namespace Database\Seeders;

use App\Models\CaseFile;
use App\Models\Customer;
use App\Models\EventType;
use App\Models\File;
use App\Models\Folder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
    use WithoutModelEvents;
    public function run(): void {
        $roles = ['admin','lawyer','secretary'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
        $eventTypes = ['hearing','client_meeting','judge_meeting'];
        foreach ($eventTypes as $eventType) {
            EventType::firstOrCreate(['name' => $eventType]);
        }
        $adminRole = Role::where('name','admin')->first()->id;
        $lawyerRole = Role::where('name','lawyer')->first()->id;
        $secretaryRole = Role::where('name','secretary')->first()->id;
        User::create([
            'document_type' => 'dni',
            'nro_document' => '74877861',
            'first_name' => 'MAURO FERNANDO',
            'paternal_name' => 'CARITAS',
            'maternal_name' => 'BORJA',
            'email' => 'mfcaritasbdos@gmail.com',
            'password' => '123456789',
            'phone' => '987590855',
            'register_cal' => null,
            'profile_photo' => null,
            'role_id' => $adminRole,
            'lawyer_id' => null,
        ]);
        $lawyers = User::factory(3)->create([
            'role_id' => $lawyerRole,
        ]);
        foreach ($lawyers as $lawyer) {
            User::factory(random_int(1,3))->create([
                'role_id' => $secretaryRole,
                'register_cal' => null,
                'lawyer_id' => $lawyer->id,
            ]);
        }        
        $customers = Customer::factory(15)->create();
        foreach ($customers as $customer) {
            CaseFile::factory(random_int(1,3))->create([
                'customer_id' => $customer->id,
                'lawyer_id' => $lawyer->inRandomOrder()->first()->id,
            ]);
        }
        $allUsers = User::all();
        $allCases = CaseFile::all();
        foreach ($allCases as $case) {
            $roots = Folder::factory(random_int(2, 3))->create([
                'case_id' => $case->id,
                'created_by' => $allUsers->random()->id,
                'parent_id' => null,
            ]);
            foreach ($roots as $root) {
                $children = Folder::factory(random_int(1, 3))->create([
                    'case_id' => $case->id,
                    'created_by' => $allUsers->random()->id,
                    'parent_id' => $root->id,
                ]);
                foreach ($children as $child) {
                    if (rand(0, 1)) {
                        Folder::factory()->create([
                            'case_id' => $case->id,
                            'created_by' => $allUsers->random()->id,
                            'parent_id' => $child->id,
                        ]);
                    }
                }
            }
        }
        $allFolders = Folder::all();
        foreach ($allFolders as $folder) {
            File::factory(random_int(1, 5))->create([
                'folder_id' => $folder->id,
                'uploaded_by' => $allUsers->random()->id,
            ]);
        }
    }
}