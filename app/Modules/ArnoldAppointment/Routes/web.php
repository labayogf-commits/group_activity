<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController; // Imported neatly at the top
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// All Dashboard routes grouped together securely under Auth
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/interview', [DashboardController::class, 'store'])->name('interviews.store');
    Route::put('/dashboard/interview/{id}', [DashboardController::class, 'update'])->name('interviews.update'); // Handles date & time edits
    
    // ArnoldAppointment module routes
    Route::get('/arnold/appointments', [AppointmentController::class, 'index'])->name('arnold.appointments.index');
    Route::get('/arnold/appointments/create', [AppointmentController::class, 'create'])->name('arnold.appointments.create');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// uire __DIR__.'/auth.php';