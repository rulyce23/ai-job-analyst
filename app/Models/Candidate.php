<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
     * full memakai IBM Granite dan disesuaikan lagi dibantu dengan AI lain yaitu Kilo Ai
     */

class Candidate extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'email',
        'phone',
        'address',
        'birth_date',
        'gender',
        'education_level',
        'field_of_study',
        'years_of_experience',
        'work_experience',
        'skills',
        'expected_salary',
        'preferred_location',
        'work_type_preference',
        'reason',
        'status',
        'notes',
    ];

    protected $casts = [
        'skills' => 'array',
        'birth_date' => 'date',
        'expected_salary' => 'decimal:2',
    ];

    /**
     * Get the category that owns the candidate.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope a query to only include candidates with a specific status.
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include candidates from a specific category.
     */
    public function scopeInCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Get the candidate's full name and email for display.
     */
    public function getDisplayNameAttribute()
    {
        return $this->name . ' (' . $this->email . ')';
    }

    /**
     * Get the candidate's status with proper formatting.
     */
    public function getFormattedStatusAttribute()
    {
        return ucfirst($this->status);
    }

    /**
     * Check if candidate is pending review.
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if candidate is approved.
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if candidate is rejected.
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }
}
