<?php

use Illuminate\Support\Facades\Route;
use App\Modules\RomualdezStalker\Controllers\RoomController; // Matches your actual controller file name

Route::group(['prefix' => 'stalker'], function () {
    // Points to the index() function inside RoomController
    Route::get('/dashboard', [RoomController::class, 'index'])->name('stalker.index');
    
    // Points to the rooms() function inside RoomController (if you kept it)
    Route::get('/analytics', [RoomController::class, 'rooms'])->name('stalker.analytics');
});
