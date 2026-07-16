<?php

use Illuminate\Support\Facades\Route;
use App\Modules\MedicineInventory\Controllers\MedicineController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/MedicineInventory::index', [MedicineController::class, 'index'])->name('dashboard');
    Route::resource('medicines', MedicineController::class)->except(['index', 'show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require base_path('routes/auth.php');