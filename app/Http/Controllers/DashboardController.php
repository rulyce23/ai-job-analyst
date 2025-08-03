<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobRecommendation;
use App\Models\JobRole;
use App\Models\Skill;
use App\Models\Candidate;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $recommendations = JobRecommendation::where('user_id', $user->id)
            ->with('jobRole')
            ->orderBy('match_score', 'desc')
            ->take(5)
            ->get();
        
        $profileCompletion = $this->calculateProfileCompletion($user);
        
        $stats = [
            'total_recommendations' => JobRecommendation::where('user_id', $user->id)->count(),
            'high_match_jobs' => JobRecommendation::where('user_id', $user->id)->where('match_score', '>=', 80)->count(),
            'saved_jobs' => JobRecommendation::where('user_id', $user->id)->where('is_saved', true)->count(),
            'user_skills_count' => $user->skills()->count(),
        ];
        
        $trendingCategories = JobRole::select('category')
            ->selectRaw('COUNT(*) as job_count')
            ->where('is_active', true)
            ->groupBy('category')
            ->orderBy('job_count', 'desc')
            ->take(5)
            ->get();
        
        // For admin users, show all pending candidates; for regular users, show only their own candidates
        $pendingCandidatesQuery = Candidate::with(['category', 'user.profile'])
            ->where('status', 'pending')
            ->orderBy('applied_at', 'desc')
            ->take(5);
            
        // Check if user is admin (using the same logic as AdminMiddleware)
        $isAdmin = (Auth::check() && (Auth::user()->email === 'admin@example.com' || Auth::user()->name === 'admin'));
        
        if (!$isAdmin) {
            $pendingCandidatesQuery->where('user_id', $user->id);
        }
        
        $pendingCandidates = $pendingCandidatesQuery->get();
        
        $candidateStats = [
            'total_candidates' => Candidate::count(),
            'pending_candidates' => Candidate::where('status', 'pending')->count(),
            'approved_candidates' => Candidate::where('status', 'approved')->count(),
            'rejected_candidates' => Candidate::where('status', 'rejected')->count(),
        ];
        
        return view('dashboard', compact('recommendations', 'profileCompletion', 'stats', 'trendingCategories', 'pendingCandidates', 'candidateStats'));
    }
    
    private function calculateProfileCompletion($user)
    {
        $profile = $user->profile;
        $completionFields = 0;
        $totalFields = 10;
        
        if ($profile) {
            if ($profile->full_name) $completionFields++;
            if ($profile->phone) $completionFields++;
            if ($profile->education_level) $completionFields++;
            if ($profile->field_of_study) $completionFields++;
            if ($profile->years_of_experience > 0) $completionFields++;
            if ($profile->work_experience) $completionFields++;
            if ($profile->career_goals) $completionFields++;
            if ($profile->expected_salary) $completionFields++;
            if ($profile->preferred_location) $completionFields++;
        }
        
        // Memeriksa keterampilan pengguna
        if ($user->skills()->count() > 0) $completionFields++;
        
        return round(($completionFields / $totalFields) * 100);
    }
    
    public function toggleSaveJob(Request $request, $recommendationId)
    {
        $recommendation = JobRecommendation::where('user_id', Auth::id())
            ->findOrFail($recommendationId);
        
        $recommendation->is_saved = !$recommendation->is_saved;
        $recommendation->save();
        
        return response()->json([
            'success' => true,
            'is_saved' => $recommendation->is_saved,
            'message' => $recommendation->is_saved ? 'Pekerjaan disimpan!' : 'Pekerjaan dihapus dari simpanan!'
        ]);
    }
    
    public function markAsViewed($recommendationId)
    {
        $recommendation = JobRecommendation::where('user_id', Auth::id())
            ->findOrFail($recommendationId);
        
        $recommendation->is_viewed = true;
        $recommendation->save();
        
        return response()->json(['success' => true]);
    }
}
