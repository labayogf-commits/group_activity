<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Modules\ChristianPagupitan\Controllers\BarberController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [BarberController::class, 'index'])
        ->name('dashboard');

});

// CRUD
Route::post('/items', [BarberController::class, 'store'])->name('items.store');
Route::put('/items/{id}', [BarberController::class, 'update'])->name('items.update');
Route::delete('/items/{id}', [BarberController::class, 'destroy'])->name('items.destroy');

// Profile
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require base_path('routes/auth.php');