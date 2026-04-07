<?php
namespace Database\Seeders;
use App\Models\Role;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Seeder;
class UserSeeder extends Seeder {
    public function run(): void {
        $adminRole = Role::where('role_code', 'admin')->first();
        $lawyerRole = Role::where('role_code', 'lawyer')->first();
        $secretaryRole = Role::where('role_code', 'secretary')->first();
        $admin = User::create([
            'document_type' => 'dni',
            'document_number' => '74877861',
            'names' => 'Mauro Fernando',
            'paternal_surname' => 'Caritas',
            'maternal_surname' => 'Borja',
            'email' => 'mfcaritasbdo@gmail.com',
            'password' => bcrypt('123456789'),
            'phone' => '987590855',
            'tuition_number' => null,
            'profile_photo' => null,
            'is_active' => 1,
            'last_login_at' => null,
            'lawyer_id' => null,
        ]);
        $admin->roles()->attach($adminRole->id);
        $lawyers = User::factory(5)->create();
        foreach ($lawyers as $lawyer) {
            $lawyer->roles()->attach($lawyerRole->id);
            $lawyer->update([
                'tuition_number' => rand(10000, 99999),
            ]);
            $specialties = Specialty::inRandomOrder()->limit(rand(1, 3))->pluck('id');
            $lawyer->specialties()->sync($specialties);
        }
        $secretaries = User::factory(9)->create();
        foreach ($secretaries as $secretary) {
            $secretary->roles()->attach($secretaryRole->id);
            $secretary->update([
                'lawyer_id' => $lawyers->random()->id,
            ]);
        }
    }
}