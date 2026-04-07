<?php
namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
class UserSeeder extends Seeder {
    public function run(): void {
        $adminRole = Role::where('role_code', 'admin')->first()->id;
        $lawyerRole = Role::where('role_code', 'lawyer')->first()->id;
        $secretaryRole = Role::where('role_code', 'secretary')->first()->id;
        $admin = User::create([
            'document_type' => 'dni',
            'document_number' => '74877861',
            'names' => 'Mauro Fernando',
            'paternal_surname' => 'Caritas',
            'maternal_surname' => 'Borja',
            'email' => 'mfcaritasbdo@gmail.com',
            'password' => '123456789',
            'phone' => '987590855',
            'lawyer_id' => null,
            'tuition_number' => null,
            'profile_photo' => null,
            'is_active' => 1,
            'last_login_at' => null,
        ]);
        $admin->roles()->attach($adminRole);
        for ($i=1; $i < 5; $i++) { 
            $lawyer = User::factory()->create([
                'lawyer_id' => null,
                'tuition_number' => rand(10000,99999),
            ]);
            $lawyer->roles()->attach($lawyerRole);
        }
        for ($i=1; $i < 16; $i++) {
            $lawyerLis = User::where('lawyer_id',null)->get();
            $secretary = User::factory()->create([
                'lawyer_id' => $lawyerLis->random()->id,
            ]);
            $secretary->roles()->attach($secretaryRole);
        }
    }
}