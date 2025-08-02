<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Category;

class DecisionController extends Controller
{
    /**
     * Display the decision making interface with categories and candidates.
     */
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)->withCount('candidates')->get();
        
        $query = Candidate::with('category');
        
        // Filter by category if specified
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        
        // Filter by status if specified
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Search by name or email
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        
        $candidates = $query->orderBy('applied_at', 'desc')->paginate(10);
        
        // Get statistics
        $stats = [
            'total' => Candidate::count(),
            'pending' => Candidate::where('status', 'pending')->count(),
            'approved' => Candidate::where('status', 'approved')->count(),
            'rejected' => Candidate::where('status', 'rejected')->count(),
        ];
        
        return view('decisions.index', compact('categories', 'candidates', 'stats'));
    }
    
    /**
     * Make a decision on a candidate (approve/reject).
     */
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
    
    /**
     * Get candidate details for the decision modal.
     */
    public function show(Candidate $candidate)
    {
        $candidate->load('category');
        
        return response()->json([
            'candidate' => $candidate
        ]);
    }
    
    /**
     * Bulk decision making for multiple candidates.
     */
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
