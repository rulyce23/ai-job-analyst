<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class DecisionController extends Controller
{
    /**
     * full memakai IBM Granite dan disesuaikan lagi dibantu dengan AI lain yaitu Kilo Ai
     */
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)->withCount('candidates')->get();
        
        $query = Candidate::with(['category', 'user']);
        
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        
        // For non-admin users, only show their own candidates
        if (!(Auth::user()->email === 'admin123@example.com' || Auth::user()->name === 'Admin' || Auth::user()->email === 'Test@example.com' || Auth::user()->name === 'Test')) {
            $query->where('user_id', Auth::id());
        } else {
            // For admin users, show candidates where company_name matches user's company_name OR user_id matches
            $adminCompanyName = Auth::user()->company_name;
            if ($adminCompanyName) {
                $query->where(function ($q) use ($adminCompanyName) {
                    $q->where('company_name', $adminCompanyName)
                      ->orWhere('user_id', Auth::id());
                });
            }
        }
        
        $candidates = $query->orderBy('applied_at', 'desc')->paginate(10);
        $stats = [
            'total' => Candidate::count(),
            'pending' => Candidate::where('status', 'pending')->count(),
            'approved' => Candidate::where('status', 'approved')->count(),
            'rejected' => Candidate::where('status', 'rejected')->count(),
        ];
        
        return view('decisions.index', compact('categories', 'candidates', 'stats'));
    }
    
    public function decide(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'decision' => 'required|in:approved,rejected',
            'notes' => 'nullable|string|max:1000',
            'score' => 'nullable|numeric|min:0|max:100',
        ]);
        
        $candidate = Candidate::findOrFail($request->candidate_id);
        
        $candidate->update([
            'status' => $request->decision,
            'notes' => $request->notes,
            'score' => $request->score,
            'decided_at' => now(),
            'reviewed_at' => now(),
        ]);
        
        $message = $request->decision === 'approved'
            ? 'Candidate has been approved successfully!'
            : 'Candidate has been rejected.';
            
        return response()->json([
            'success' => true,
            'message' => $message,
            'candidate' => $candidate->load('category')
        ]);
    }
    
    public function show(Candidate $candidate)
    {
        $candidate->load(['category', 'user.profile']);
        
        // Ensure skills is an array for frontend usage
        if (is_string($candidate->skills)) {
            $candidate->skills = json_decode($candidate->skills, true) ?? [];
        }
        
        // Prepare data with corrected fields for frontend display
        $candidateData = [
            'id' => $candidate->id,
            'name' => $candidate->name,
            'email' => $candidate->email,
            'phone' => $candidate->phone,
            'category' => $candidate->category ? $candidate->category->name : 'Tidak ada kategori',
            'years_of_experience' => $candidate->years_of_experience ?? 0,
            'education_level' => $candidate->education_level ?? 'Tidak disebutkan',
            'field_of_study' => $candidate->field_of_study ?? '',
            'skills' => $candidate->skills ?? [],
            'reason' => $candidate->reason ?? 'Tidak ada alasan yang diberikan',
            'expected_salary' => $candidate->expected_salary ?? 0,
            'preferred_location' => $candidate->preferred_location ?? 'Fleksibel',
            'work_type_preference' => $candidate->work_type_preference ?? 'Hybrid',
            'status' => $candidate->status,
            'user' => $candidate->user ? [
                'name' => $candidate->user->name,
                'email' => $candidate->user->email,
                'profile' => $candidate->user->profile ? [
                    'phone' => $candidate->user->profile->phone ?? 'Tidak disebutkan',
                    'years_of_experience' => $candidate->user->profile->years_of_experience ?? 0,
                ] : null,
            ] : null,
        ];
        
        return response()->json([
            'candidate' => $candidateData
        ]);
    }

    // Kilo AI
    public function bulkDecide(Request $request)
    {
        $request->validate([
            'candidate_ids' => 'required|array',
            'candidate_ids.*' => 'exists:candidates,id',
            'decision' => 'required|in:approved,rejected',
            'notes' => 'nullable|string|max:1000',
        ]);
        
        $updated = Candidate::whereIn('id', $request->candidate_ids)
            ->update([
                'status' => $request->decision,
                'notes' => $request->notes,
                'decided_at' => now(),
                'reviewed_at' => now(),
            ]);
        
        $message = $request->decision === 'approved'
            ? "{$updated} candidates have been approved successfully!"
            : "{$updated} candidates have been rejected.";
            
        return response()->json([
            'success' => true,
            'message' => $message,
            'updated_count' => $updated
        ]);
    }
}
