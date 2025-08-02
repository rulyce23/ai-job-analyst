<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Category;

class DecisionController extends Controller
{
    /**
     * full memakai IBM Granite dan disesuaikan lagi dibantu dengan AI lain yaitu Kilo Ai
     */
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)->withCount('candidates')->get();
        
        $query = Candidate::with('category');
        
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
        $candidate->load('category');
        
        return response()->json([
            'candidate' => $candidate
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
