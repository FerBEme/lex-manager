<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->enum('document_type',['dni','ce','ruc']);
            $table->string('document_number',11)->unique();
            $table->string('company_name',50)->nullable();
            $table->string('names')->nullable();
            $table->string('paternal_surname')->nullable();
            $table->string('maternal_surname')->nullable();
            $table->string('email')->nullable();
            $table->char('phone',9)->nullable();
            $table->string('home_address')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('customers');
    }
};
