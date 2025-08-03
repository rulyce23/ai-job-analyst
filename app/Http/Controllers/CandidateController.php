<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Category;
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
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('candidates.create', compact('categories'));
    }

    /**
     * Store a newly created candidate in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
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
            'skills' => 'required|array',
            'skills.*' => 'string',
            'expected_salary' => 'required|numeric|min:0',
            'preferred_location' => 'required|string|max:100',
            'work_type_preference' => 'required|in:onsite,remote,hybrid',
            'reason' => 'required|string',
        ]);
        
        // Handle skills if it's a string instead of an array
        if (is_string($request->skills)) {
            $skillsArray = explode(',', $request->skills);
            $skillsArray = array_map('trim', $skillsArray);
            $skillsArray = array_filter($skillsArray, function($value) { return $value !== ''; });
            $request->merge(['skills' => $skillsArray]);
        }

        $candidateData = $request->all();
        $candidateData['status'] = 'pending';
        $candidateData['applied_at'] = now();
        $candidateData['user_id'] = Auth::id(); // Menambahkan user_id dari user yang sedang login

        Candidate::create($candidateData);

        return redirect()->route('decisions.index')
            ->with('success', 'Kandidat berhasil ditambahkan dan menunggu keputusan.');
    }
}