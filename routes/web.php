<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobAnalysisController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\DecisionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/save-job/{recommendation}', [DashboardController::class, 'toggleSaveJob'])->name('dashboard.save-job');
    Route::post('/dashboard/mark-viewed/{recommendation}', [DashboardController::class, 'markAsViewed'])->name('dashboard.mark-viewed');
    
    // Job Analysis
    Route::get('/job-analysis', [JobAnalysisController::class, 'index'])->name('job-analysis.index');
    Route::post('/job-analysis', [JobAnalysisController::class, 'analyze'])->name('job-analysis.analyze');
    
    // User Profile Management
    Route::get('/profile/complete', [UserProfileController::class, 'edit'])->name('profile.complete');
    Route::put('/profile/complete', [UserProfileController::class, 'update'])->name('profile.complete.update');
    Route::get('/profile/skills', [UserProfileController::class, 'skills'])->name('profile.skills');
    Route::put('/profile/skills', [UserProfileController::class, 'updateSkills'])->name('profile.skills.update');
    
    // Decision Making for Candidates
    Route::get('/decisions', [DecisionController::class, 'index'])->name('decisions.index');
    Route::get('/decisions/candidate/{candidate}', [DecisionController::class, 'show'])->name('decisions.show');
    Route::post('/decisions/decide', [DecisionController::class, 'decide'])->name('decisions.decide');
    Route::post('/decisions/bulk-decide', [DecisionController::class, 'bulkDecide'])->name('decisions.bulk-decide');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
