<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'address',
        'birth_date',
        'gender',
        'education_level',
        'field_of_study',
        'years_of_experience',
        'work_experience',
        'interests',
        'career_goals',
        'expected_salary',
        'preferred_location',
        'work_type_preference',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'expected_salary' => 'decimal:2',
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
