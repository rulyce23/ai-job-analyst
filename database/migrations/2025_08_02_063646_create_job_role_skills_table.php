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
        Schema::create('job_role_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_role_id')->constrained()->onDelete('cascade');
            $table->foreignId('skill_id')->constrained()->onDelete('cascade');
            $table->integer('importance_level')->default(1); // 1-5 scale (1=nice to have, 5=required)
            $table->integer('min_proficiency_level')->default(1); // minimum proficiency required
            $table->timestamps();
            
            $table->unique(['job_role_id', 'skill_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_role_skills');
    }
};
