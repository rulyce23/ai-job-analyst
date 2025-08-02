<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skill;
use App\Models\JobRole;
use App\Models\JobRecommendation;
use Illuminate\Support\Facades\Auth;

class JobAnalysisController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('category')->orderBy('name')->get();
        $user = Auth::user();
        $userProfile = $user->profile;
        $userSkills = $user->skills()->get();
        
        return view('job-analysis.index', compact('skills', 'userProfile', 'userSkills'));
    }

    public function analyze(Request $request)
    {

        // saya disini memakai IBM Granite karena terdapat error saat insert dan errornya ternyata kurang full_name required dan $request full_name untuk diinputkan
        
        $request->validate([
            'skills' => 'required|array|min:1',
            'skills.*' => 'exists:skills,id',
            'experience_years' => 'required|integer|min:0',
            'preferred_salary' => 'nullable|numeric|min:0',
            'work_type' => 'required|in:remote,onsite,hybrid',
            'location' => 'nullable|string|max:255',
            'full_name'=> 'required|string|max:255'
        ]);

        $user = Auth::user();
        
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'years_of_experience' => $request->experience_years,
                'expected_salary' => $request->preferred_salary,
                'work_type_preference' => $request->work_type,
                'preferred_location' => $request->location,
                'full_name'=> $request->full_name
            ]
        );

        $skillsData = [];
        foreach ($request->skills as $skillId) {
            $proficiencyLevel = $request->input("skill_proficiency.{$skillId}", 3);
            $skillsData[$skillId] = [
                'proficiency_level' => $proficiencyLevel,
                'years_of_experience' => min($request->experience_years, 10),
            ];
        }
        $user->skills()->sync($skillsData);

        // Generate job recommendations
        $recommendations = $this->generateRecommendations($user);

        return view('job-analysis.results', compact('recommendations'));
    }

    private function generateRecommendations(User $user)
    {
        $userSkills = $user->skills()->get();
        $userProfile = $user->profile;
        
        $jobRoles = JobRole::where('is_active', true)->with('skills')->get();
        
        $recommendations = [];
        
        foreach ($jobRoles as $jobRole) {
            $matchScore = $this->calculateMatchScore($userSkills, $jobRole, $userProfile);
            
            if ($matchScore >= 30) { // Only show jobs with at least 30% match
                $matchingSkills = $this->getMatchingSkills($userSkills, $jobRole);
                $missingSkills = $this->getMissingSkills($userSkills, $jobRole);
                
                $recommendation = JobRecommendation::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'job_role_id' => $jobRole->id,
                    ],
                    [
                        'match_score' => $matchScore,
                        'matching_skills' => $matchingSkills,
                        'missing_skills' => $missingSkills,
                        'recommendation_reason' => $this->generateRecommendationReason($matchScore, $matchingSkills, $missingSkills),
                    ]
                );
                
                $recommendations[] = $recommendation->load('jobRole');
            }
        }
        
        // Sort by match score descending
        return collect($recommendations)->sortByDesc('match_score')->take(10);
    }

    private function calculateMatchScore($userSkills, JobRole $jobRole, $userProfile)
    {
        $jobSkills = $jobRole->skills;
        $totalJobSkills = $jobSkills->count();
        
        if ($totalJobSkills === 0) {
            return 0;
        }
        
        $matchedSkills = 0;
        $weightedScore = 0;
        
        foreach ($jobSkills as $jobSkill) {
            $userSkill = $userSkills->firstWhere('id', $jobSkill->id);
            
            if ($userSkill) {
                $matchedSkills++;
                
                $importanceWeight = $jobSkill->pivot->importance_level / 5;
                $proficiencyScore = $userSkill->pivot->proficiency_level / 5;
                $minProficiency = $jobSkill->pivot->min_proficiency_level / 5;
                
                if ($proficiencyScore >= $minProficiency) {
                    $weightedScore += $importanceWeight * $proficiencyScore;
                } else {
                    $weightedScore += $importanceWeight * $proficiencyScore * 0.5 ;
                }
            }
        }
        
        $baseScore = ($matchedSkills / $totalJobSkills) * 100;
        
        $weightedAdjustment = ($weightedScore / $totalJobSkills) * 20;
        
        $experienceBonus = 0;
        if ($userProfile && $userProfile->years_of_experience >= $jobRole->min_experience_years) {
            $experienceBonus = 10;
        } elseif ($userProfile && $userProfile->years_of_experience < $jobRole->min_experience_years) {
            $experienceBonus = -5;
        }
        
        return min(100, max(0, $baseScore + $weightedAdjustment + $experienceBonus));
    }

    private function getMatchingSkills($userSkills, JobRole $jobRole)
    {
        $jobSkillIds = $jobRole->skills->pluck('id')->toArray();
        $userSkillIds = $userSkills->pluck('id')->toArray();
        
        $matchingSkillIds = array_intersect($userSkillIds, $jobSkillIds);
        
        return Skill::whereIn('id', $matchingSkillIds)->pluck('name')->toArray();
    }

    private function getMissingSkills($userSkills, JobRole $jobRole)
    {
        $jobSkillIds = $jobRole->skills->where('pivot.importance_level', '>=', 4)->pluck('id')->toArray();
        $userSkillIds = $userSkills->pluck('id')->toArray();
        
        $missingSkillIds = array_diff($jobSkillIds, $userSkillIds);
        
        return Skill::whereIn('id', $missingSkillIds)->pluck('name')->toArray();
    }


    private function generateRecommendationReason($matchScore, $matchingSkills, $missingSkills)
    {
        $reason = "Berdasarkan analisis AI, Anda memiliki {$matchScore}% kesesuaian dengan posisi ini. ";
        
        if (!empty($matchingSkills)) {
            $skillsList = implode(', ', array_slice($matchingSkills, 0, 3));
            $reason .= "Keahlian yang sesuai: {$skillsList}. ";
        }
        
        if (!empty($missingSkills)) {
            $missingList = implode(', ', array_slice($missingSkills, 0, 2));
            $reason .= "Untuk meningkatkan peluang, pertimbangkan untuk mengembangkan: {$missingList}.";
        }
        
        return $reason;
    }
}
