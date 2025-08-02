<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
     * full memakai IBM Granite dan disesuaikan lagi dibantu dengan AI lain yaitu Kilo Ai
     */

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'color',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the candidates for the category.
     */
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
