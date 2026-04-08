<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('file_locations', function (Blueprint $table) {
            $table->id();
            $table->string('file_location_code',50)->unique();
            $table->string('name',50);
            $table->text('description')->nullable();
        });
    }
    public function down(): void {
        Schema::dropIfExists('file_locations');
    }
};