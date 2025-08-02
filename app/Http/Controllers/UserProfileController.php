<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile;
        $skills = Skill::orderBy('category')->orderBy('name')->get();
        $userSkills = $user->skills()->get();
        
        return view('profile.complete', compact('profile', 'skills', 'userSkills'));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'birth_date' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'education_level' => 'nullable|string|max:100',
            'field_of_study' => 'nullable|string|max:100',
            'years_of_experience' => 'required|integer|min:0|max:50',
            'work_experience' => 'nullable|string|max:2000',
            'interests' => 'nullable|string|max:1000',
            'career_goals' => 'nullable|string|max:1000',
            'expected_salary' => 'nullable|numeric|min:0',
            'preferred_location' => 'nullable|string|max:255',
            'work_type_preference' => 'required|in:remote,onsite,hybrid',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);
        
        $user = Auth::user();
        
        // Update or create user profile
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only([
                'full_name', 'phone', 'address', 'birth_date', 'gender',
                'education_level', 'field_of_study', 'years_of_experience',
                'work_experience', 'interests', 'career_goals', 'expected_salary',
                'preferred_location', 'work_type_preference'
            ])
        );
        
        // Update user skills if provided
        if ($request->has('skills')) {
            $skillsData = [];
            foreach ($request->skills as $skillId) {
                $proficiencyLevel = $request->input("skill_proficiency.{$skillId}", 3);
                $yearsExp = $request->input("skill_years.{$skillId}", 0);
                $isCertified = $request->boolean("skill_certified.{$skillId}");
                
                $skillsData[$skillId] = [
                    'proficiency_level' => $proficiencyLevel,
                    'years_of_experience' => $yearsExp,
                    'is_certified' => $isCertified,
                ];
            }
            $user->skills()->sync($skillsData);
        }
        
        return redirect()->route('profile.edit')
            ->with('success', 'Profil berhasil diperbarui!');
    }
    
    public function skills()
    {
        $user = Auth::user();
        $skills = Skill::orderBy('category')->orderBy('name')->get();
        $userSkills = $user->skills()->get();
        
        return view('profile.skills', compact('skills', 'userSkills'));
    }
    
    public function updateSkills(Request $request)
    {
        $request->validate([
            'skills' => 'required|array|min:1',
            'skills.*' => 'exists:skills,id',
        ]);
        
        $user = Auth::user();
        $skillsData = [];
        
        foreach ($request->skills as $skillId) {
            $proficiencyLevel = $request->input("proficiency.{$skillId}", 3);
            $yearsExp = $request->input("years.{$skillId}", 0);
            $isCertified = $request->boolean("certified.{$skillId}");
            
            $skillsData[$skillId] = [
                'proficiency_level' => $proficiencyLevel,
                'years_of_experience' => $yearsExp,
                'is_certified' => $isCertified,
            ];
        }
        
        $user->skills()->sync($skillsData);
        
        return redirect()->route('profile.skills')
            ->with('success', 'Keahlian berhasil diperbarui!');
    }
}
