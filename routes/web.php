<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobAnalysisController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\DecisionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

Route::get('/', function () {
    return view('welcome');
});

// Health check routes for Railway
Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => now(),
        'app' => 'AI Job Analyst',
        'version' => '1.0.0',
        'environment' => config('app.env'),
        'database' => DB::connection()->getPdo() ? 'connected' : 'disconnected'
    ]);
});

Route::get('/api/health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => now(),
        'app' => 'AI Job Analyst',
        'version' => '1.0.0'
    ]);
});

// Spatie Health Check Route
Route::get('/health-check', function () {
    try {
        // Basic health checks
        $checks = [
            'database' => DB::connection()->getPdo() ? true : false,
            'cache' => Cache::store()->has('health_check') !== false,
            'app_key' => config('app.key') && config('app.key') !== 'base64:',
            'environment' => config('app.env') ? true : false,
        ];

        $allHealthy = !in_array(false, $checks);

        return response()->json([
            'status' => $allHealthy ? 'healthy' : 'unhealthy',
            'timestamp' => now(),
            'checks' => $checks,
            'app' => 'AI Job Analyst'
        ], $allHealthy ? 200 : 503);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'unhealthy',
            'error' => $e->getMessage(),
            'timestamp' => now()
        ], 503);
    }
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
