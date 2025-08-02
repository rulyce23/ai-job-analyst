<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('education_level')->nullable();
            $table->string('field_of_study')->nullable();
            $table->integer('years_of_experience')->default(0);
            $table->text('work_experience')->nullable();
            $table->text('interests')->nullable();
            $table->text('career_goals')->nullable();
            $table->decimal('expected_salary', 12, 2)->nullable();
            $table->string('preferred_location')->nullable();
            $table->enum('work_type_preference', ['remote', 'onsite', 'hybrid'])->default('hybrid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
