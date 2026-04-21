<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->enum('document_type',['dni','ce','ruc']);
            $table->string('nro_document',12)->unique();
            $table->string('company_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('paternal_name')->nullable();
            $table->string('maternal_name')->nullable();
            $table->char('phone',9);
            $table->string('email')->nullable();
            $table->text('address');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('customers');
    }
};