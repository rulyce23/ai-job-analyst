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
        Schema::create('job_roles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('category'); // e.g., 'IT', 'Marketing', 'Finance', etc.
            $table->string('level'); // e.g., 'Entry', 'Mid', 'Senior', 'Executive'
            $table->decimal('min_salary', 12, 2)->nullable();
            $table->decimal('max_salary', 12, 2)->nullable();
            $table->integer('min_experience_years')->default(0);
            $table->text('responsibilities')->nullable();
            $table->text('requirements')->nullable();
            $table->string('work_type')->default('hybrid'); // remote, onsite, hybrid
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_roles');
    }
};
