<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'demand_level',
    ];

    /**
     * Get the users that have this skill.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skills')
                    ->withPivot('proficiency_level', 'years_of_experience', 'is_certified')
                    ->withTimestamps();
    }

    /**
     * Get the job roles that require this skill.
     */
    public function jobRoles()
    {
        return $this->belongsToMany(JobRole::class, 'job_role_skills')
                    ->withPivot('importance_level', 'min_proficiency_level')
                    ->withTimestamps();
    }
}
