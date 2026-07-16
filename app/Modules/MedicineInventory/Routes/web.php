<?php

use Illuminate\Support\Facades\Route;
use App\Modules\MedicineInventory\Controllers\MedicineController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
    Route::resource('medicines', MedicineController::class)->except(['index', 'show']);
});