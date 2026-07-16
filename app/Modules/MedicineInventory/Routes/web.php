<?php

use Illuminate\Support\Facades\Route;
use App\Modules\MedicineInventory\Controllers\MedicineController;

Route::get('/medicine', [MedicineController::class, 'index'])->name('medicine.index');
Route::get('/medicine/create', [MedicineController::class, 'create'])->name('medicine.create');
