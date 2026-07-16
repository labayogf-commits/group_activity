<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AnthonyHSM\Controllers\HardwareController; // <--- Dapat 'AnthonyHSM' ito!

Route::get('/hardware-portal', [HardwareController::class, 'index'])->name('hardware.index');
Route::post('/hardware-portal', [HardwareController::class, 'store'])->name('hardware.store');
Route::delete('/hardware-portal/{id}', [HardwareController::class, 'destroy'])->name('hardware.destroy');

Route::get('/login', [HardwareController::class, 'login'])->name('login');