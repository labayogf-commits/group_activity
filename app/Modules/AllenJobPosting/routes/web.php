<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Modules\AllenJobPosting\Controllers\JobController;
use App\Modules\AllenJobPosting\Controllers\ApplicationController;

// Home
Route::get('/', function () {
    $jobs = Job::latest()->take(5)->get();
    return view('welcome', compact('jobs'));
});

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // =====================
    // Profile
    // =====================

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // =====================
    // Jobs
    // =====================

    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');

    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');

    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

    // EDIT
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');

    // UPDATE
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');

    // DELETE
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');


    // =====================
    // Apply
    // =====================

    Route::get('/jobs/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply');

    Route::post('/jobs/{job}/apply', [JobController::class, 'submitApplication'])
        ->name('jobs.apply.submit');

    Route::get('/my-applications', [JobController::class, 'myApplications'])
        ->name('applications.index');


    // =====================
    // Employer Approval
    // =====================

    Route::get('/applications/approvals',
        [ApplicationController::class, 'approvals'])
        ->name('applications.approvals');

    Route::patch('/applications/{application}/update',
        [ApplicationController::class, 'update'])
        ->name('applications.update');

});