<?php
namespace Database\Seeders;
use App\Models\Customer;
use App\Models\Event;
use App\Models\Payment;
use App\Models\Receipt;
use App\Models\Template;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
    public function run(): void {
        Customer::factory(20)->create();
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            SpecialtySeeder::class,
            FileStatusSeeder::class,
            FileLocationSeeder::class,
            UserSeeder::class,
            CaseFileSeeder::class,
            FolderSeeder::class,
            FileSeeder::class,
            EventTypeSeeder::class,
        ]);
        Event::factory(25)->create();
        Payment::factory(120)->create();
        Receipt::factory(150)->create();
        Template::factory(30)->create();
    }
}