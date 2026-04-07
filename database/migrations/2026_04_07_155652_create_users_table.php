<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('document_type',['dni','ce']);
            $table->char('document_number',9)->unique();
            $table->string('names');
            $table->string('paternal_surname');
            $table->string('maternal_surname');
            $table->string('email')->unique();
            $table->string('password');
            $table->char('phone',9)->nullable();
            $table->char('tuition_number',5)->nullable()->unique();
            $table->string('profile_photo')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->datetime('last_login_at')->nullable();
            $table->foreignId('lawyer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('users');
    }
};
