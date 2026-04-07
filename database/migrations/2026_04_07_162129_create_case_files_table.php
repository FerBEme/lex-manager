<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('case_files', function (Blueprint $table) {
            $table->id();
            $table->string('file_number',30)->unique();
            $table->string('jurisdictional_body',100);
            $table->string('judicial_district',100);
            $table->string('judge',100)->nullable();
            $table->string('legal_specialist',100);
            $table->date('start_date');
            $table->string('process',100)->nullable();
            $table->string('subject')->nullable();
            $table->date('completion_date')->nullable();
            $table->text('reason_conclusion');
            $table->foreignId('specialty_id')->constrained('specialties')->cascadeOnDelete();
            $table->foreignId('status_id')->constrained('file_statuses')->cascadeOnDelete();
            $table->foreignId('location_id')->constrained('file_locations')->cascadeOnDelete();
            $table->foreignId('lawyer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('case_files');
    }
};