<?php

use Illuminate\Support\Facades\Route;
use App\Modules\RomualdezStalker\Controllers\RoomController;

Route::group(['prefix' => 'stalker'], function () {
    Route::get('/dashboard', [RoomController::class, 'index'])->name('stalker.index');
    Route::post('/store', [RoomController::class, 'store'])->name('stalker.store');
    Route::put('/{id}', [RoomController::class, 'update'])->name('stalker.update');
    Route::delete('/{id}', [RoomController::class, 'destroy'])->name('stalker.destroy');
});
