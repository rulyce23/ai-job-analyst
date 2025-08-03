<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Category;
use App\Models\JobRole;
use App\Models\JobRecommendation;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    public function create(Request $request)
    {
        $jobRecommendationId = $request->input('job_recommendation_id');
        $jobRecommendation = null;
        $category = null;
        $categories = JobRole::all();
        if ($jobRecommendationId) {
            $jobRecommendation = JobRecommendation::find($jobRecommendationId);
            if ($jobRecommendation) {
                $category = $jobRecommendation->jobRole->title ? JobRole::where('title', $jobRecommendation->jobRole->title)->first() : null;
            }
        }
        return view('candidates.create', compact('jobRecommendationId', 'jobRecommendation', 'category', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|string|max:10',
            'education_level' => 'nullable|string|max:50',
            'field_of_study' => 'nullable|string|max:100',
            'years_of_experience' => 'nullable|integer|min:0',
            'work_experience' => 'nullable|string',
            'skills' => 'nullable|string',
            'expected_salary' => 'nullable|numeric|min:0',
            'preferred_location' => 'nullable|string|max:100',
            'work_type_preference' => 'nullable|string|max:50',
            'reason' => 'nullable|string',
            'status' => 'nullable|string|in:pending,approved,rejected',
            'notes' => 'nullable|string',
            'company_name' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:job_roles,id',
        ]);

        $candidateData = $request->only([
            'name', 'email', 'phone', 'address', 'birth_date', 'gender',
            'education_level', 'field_of_study', 'years_of_experience', 'work_experience',
            'skills', 'expected_salary', 'preferred_location', 'work_type_preference',
            'reason', 'status', 'notes', 'company_name', 'category_id'
        ]);

        // Always override category_id and company_name from jobRole if job_recommendation_id is present
        if ($request->filled('job_recommendation_id')) {
            $jobRecommendation = \App\Models\JobRecommendation::find($request->input('job_recommendation_id'));
            if ($jobRecommendation && is_object($jobRecommendation->jobRole)) {
                $candidateData['category_id'] = $jobRecommendation->jobRole->id;
                $candidateData['company_name'] = $jobRecommendation->jobRole->company_name;
            }
        }

        $candidateData['user_id'] = Auth::id();
        // $candidateData['category_id'] = JobRole::id();
        // $candidateData['company_name'] = Auth::id();
        
        $candidateData['applied_at'] = now();

        Candidate::create($candidateData);

        return redirect()->route('dashboard')->with('success', 'Lamaran berhasil diajukan.');
    }
}
