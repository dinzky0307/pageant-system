<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SegmentController;

use App\Http\Controllers\Judge\DashboardController as JudgeDashboardController;
use App\Http\Controllers\Judge\ScoringController;
    use App\Http\Controllers\Admin\RankingController;
    

Route::get('/', function () {
    return view('welcome');
})->name('home');

/**
 * Breeze default landing route after login.
 * We keep the name "dashboard" but redirect by role.
 */
Route::get('/dashboard', function () {
    if (!auth()->check()) return redirect()->route('login');

    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.segments.index')
        : redirect()->route('judge.dashboard');
})->middleware(['auth'])->name('dashboard');

/**
 * Profile routes (Breeze)
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Admin routes
Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/segments', [SegmentController::class, 'index'])->name('segments.index');

    Route::post('/segments/{segment}/toggle-open', [SegmentController::class, 'toggleOpen'])
        ->name('segments.toggleOpen');

    Route::post('/segments/{segment}/release', [SegmentController::class, 'release'])
        ->name('segments.release');

    Route::get('/segments/{segment}/rankings', [SegmentController::class, 'rankings'])
        ->name('segments.rankings');

    // ✅ Top 5 Candidates (running score)
    Route::get('/rankings/top5-candidates', [RankingController::class, 'top5Candidates'])
        ->name('rankings.top5Candidates');

});


/**
 * Judge routes
 */
Route::middleware(['auth','role:judge'])->prefix('judge')->group(function () {
    Route::get('/', [JudgeDashboardController::class, 'index'])->name('judge.dashboard');
    Route::get('/scoring', [ScoringController::class, 'index'])->name('judge.scoring.index');
    Route::post('/scoring/{segment}/submit', [ScoringController::class, 'submit'])->name('judge.scoring.submit');
    Route::get('/scoring/picker', [ScoringController::class, 'picker'])
    ->name('judge.scoring.picker');
    

});



require __DIR__ . '/auth.php';
