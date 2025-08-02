<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobRole extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'level',
        'min_salary',
        'max_salary',
        'min_experience_years',
        'responsibilities',
        'requirements',
        'work_type',
        'is_active',
    ];

    protected $casts = [
        'min_salary' => 'decimal:2',
        'max_salary' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the skills required for this job role.
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_role_skills')
                    ->withPivot('importance_level', 'min_proficiency_level')
                    ->withTimestamps();
    }

    /**
     * Get the job recommendations for this role.
     */
    public function jobRecommendations()
    {
        return $this->hasMany(JobRecommendation::class);
    }
}
