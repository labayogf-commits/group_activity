<?php

use Illuminate\Support\Facades\Route;
use App\Modules\HotelManagement\Controllers\RoomController;

Route::get('/hotel', [RoomController::class, 'index'])->name('hotel.index');
Route::get('/hotel/rooms', [RoomController::class, 'rooms'])->name('hotel.rooms');
