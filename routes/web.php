<?php

use Illuminate\Support\Facades\Route;
use App\Modules\ChristianPagupitan\Controllers\BarberController;

// Change this to use barber.index explicitly
Route::get('/barber', [BarberController::class, 'index'])->name('barber.index');

// Keep your action routes below
Route::post('/items', [BarberController::class, 'store'])->name('items.store');
Route::put('/items/{id}', [BarberController::class, 'update'])->name('items.update');
Route::delete('/items/{id}', [BarberController::class, 'destroy'])->name('items.destroy');