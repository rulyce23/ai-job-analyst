<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Category;
use App\Models\JobRecommendation;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    /**
     * Display a listing of the candidates.
     */
    public function index()
    {
        // Redirect to decisions.index since that's where candidates are managed
        return redirect()->route('decisions.index');
    }

    /**
     * Show the form for creating a new candidate.
     */
    public function create(Request $request)
    {
        $categories = Category::where('is_active', true)->get();
        
        // Jika ada job recommendation ID, ambil data dari job role
        $jobRecommendation = null;
        if ($request->has('job_recommendation_id')) {
            $jobRecommendation = JobRecommendation::with('jobRole')->findOrFail($request->job_recommendation_id);
        }
        
        return view('candidates.create', compact('categories', 'jobRecommendation'));
    }

    /**
     * Store a newly created candidate in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'education_level' => 'required|string|max:50',
            'field_of_study' => 'required|string|max:100',
            'years_of_experience' => 'required|integer|min:0',
            'work_experience' => 'required|string',
            'skills' => 'required|string',
            'expected_salary' => 'required|numeric|min:0',
            'preferred_location' => 'required|string|max:100',
            'work_type_preference' => 'required|in:onsite,remote,hybrid',
            'reason' => 'required|string',
        ];

        // If job recommendation exists, category_id can be nullable
        if (!$request->has('job_recommendation_id')) {
            $rules['category_id'] = 'required|exists:categories,id';
        }

        $request->validate($rules);
        
        // Convert skills string to array
        $skillsArray = explode(',', $request->skills);
        $skillsArray = array_map('trim', $skillsArray);
        $skillsArray = array_filter($skillsArray, function($value) { return $value !== ''; });

        $candidateData = $request->all();
        $candidateData['skills'] = $skillsArray;
        $candidateData['status'] = 'pending';
        $candidateData['applied_at'] = now();
        $candidateData['user_id'] = Auth::id(); // Menambahkan user_id dari user yang sedang login
        
        // Jika ada job recommendation ID, ambil nama perusahaan dari job role
        if ($request->has('job_recommendation_id')) {
            $recommendation = JobRecommendation::with('jobRole')->find($request->job_recommendation_id);
            if ($recommendation && $recommendation->jobRole) {
                $candidateData['company_name'] = $recommendation->jobRole->company_name;
            } else {
                $candidateData['company_name'] = null;
            }
        }

        Candidate::create($candidateData);

        return redirect()->route('decisions.index')
            ->with('success', 'Kandidat berhasil ditambahkan dan menunggu keputusan.');
    }
}