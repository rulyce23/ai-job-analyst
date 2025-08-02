<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobRecommendation extends Model
{
    protected $fillable = [
        'user_id',
        'job_role_id',
        'match_score',
        'matching_skills',
        'missing_skills',
        'recommendation_reason',
        'is_viewed',
        'is_saved',
    ];

    protected $casts = [
        'match_score' => 'decimal:2',
        'matching_skills' => 'array',
        'missing_skills' => 'array',
        'is_viewed' => 'boolean',
        'is_saved' => 'boolean',
    ];

    /**
     * Get the user that owns the recommendation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the job role for this recommendation.
     */
    public function jobRole()
    {
        return $this->belongsTo(JobRole::class);
    }
}
