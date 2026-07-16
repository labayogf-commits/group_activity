<?php

use Illuminate\Support\Facades\Route;
use App\Modules\HotelManagement\Controllers\RoomController;
use App\Http\Controllers\StudentDashboardController;

Route::get('/hotel', [RoomController::class, 'index'])->name('hotel.index');

Route::middleware(['auth'])->group(function () {

    Route::get('/student-dashboard', [StudentDashboardController::class, 'index'])
        ->name('student.dashboard');

});