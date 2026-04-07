<?php
namespace Database\Seeders;

use App\Models\FileStatus;
use Illuminate\Database\Seeder;
class FileStatusSeeder extends Seeder {
    public function run(): void {
        FileStatus::insert([
            ['file_status_code' => 'PENDIENTE','description' => 'El expediente esta pendiente'],
            ['file_status_code' => 'ARCHIVADO','description' => 'El expediente fue archivado'],
        ]);
    }
}
