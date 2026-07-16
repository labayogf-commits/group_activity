<?php

use Illuminate\Support\Facades\Route;
use App\Modules\HotelManagement\Controllers\ClientController;

Route::middleware('auth')->group(function () {

    Route::get('/hotel', [ClientController::class, 'index'])->name('hotel.index');

    Route::get('/dashboard', [ClientController::class, 'index'])->name('dashboard');

    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

    Route::patch('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
});

require base_path('routes/auth.php');