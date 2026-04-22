<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('case_files', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique();
            $table->string('judicial_body')->nullable();
            $table->string('judicial_district')->nullable();
            $table->string('judge')->nullable();
            $table->string('legal_specialist')->nullable();
            $table->date('start_date');
            $table->string('process_type')->nullable();
            $table->string('specialty')->nullable();
            $table->text('subject')->nullable();
            $table->string('status',100)->nullable();
            $table->string('procedural_stage',100)->nullable();
            $table->date('end_date')->nullable();
            $table->text('conclusion_reason')->nullable();
            $table->text('location')->nullable();
            $table->text('summary')->nullable();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('lawyer_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('case_files');
    }
};