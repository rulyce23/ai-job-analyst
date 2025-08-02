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
        Schema::create('job_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_role_id')->constrained()->onDelete('cascade');
            $table->decimal('match_score', 5, 2); // percentage match (0.00 - 100.00)
            $table->json('matching_skills')->nullable(); // skills that matched
            $table->json('missing_skills')->nullable(); // skills user needs to develop
            $table->text('recommendation_reason')->nullable();
            $table->boolean('is_viewed')->default(false);
            $table->boolean('is_saved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_recommendations');
    }
};
