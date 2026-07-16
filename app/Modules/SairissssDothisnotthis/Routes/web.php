<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SairissssDothisnotthis\Controllers\TodoController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Pointing directly to SairissssDothisnotthis models to count correctly
    $totalCount = \App\Modules\SairissssDothisnotthis\Models\Todo::count();
    $notStartedCount = \App\Modules\SairissssDothisnotthis\Models\Todo::where('status', 'Not Started')->count();
    $inProgressCount = \App\Modules\SairissssDothisnotthis\Models\Todo::where('status', 'In Progress')->count();
    $completedCount = \App\Modules\SairissssDothisnotthis\Models\Todo::where('status', 'Completed')->count();
    $cancelledCount = \App\Modules\SairissssDothisnotthis\Models\Todo::where('status', 'Cancelled')->count();

    return view('dashboard', compact('totalCount', 'notStartedCount', 'inProgressCount', 'completedCount', 'cancelledCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('todos', TodoController::class);
});

require base_path('routes/auth.php');