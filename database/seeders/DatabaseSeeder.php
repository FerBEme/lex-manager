<?php
namespace Database\Seeders;
use App\Models\Customer;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            RoleSeeder::class,
            SpecialtySeeder::class,
            PermissionSeeder::class,
            FileStatusSeeder::class,
            FileLocationSeeder::class,
            UserSeeder::class,
        ]);
        Customer::factory(20)->create();
    }
}