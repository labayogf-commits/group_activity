<?php

use Illuminate\Support\Facades\Route;
use App\Modules\ResortBooking\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Modules\ResortBooking\Models\Room;


/*
|--------------------------------------------------------------------------
| Public pages (walang login kailangan)
|--------------------------------------------------------------------------
*/

// Homepage: kailangan i-pasa ang $rooms dahil ginagamit ito ng welcome.blade.php
// sa dropdown ng "Select Room"
Route::get('/', function () {
    $rooms = Room::orderBy('room_number')->get();
    return view('welcome', compact('rooms'));
})->name('home');

// Ito ang dating "Route [public.book] not defined" na error — nadagdag na ngayon
Route::post('/book', [PublicBookingController::class, 'store'])->name('public.book');
Route::get('/index', [BookingController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('index');
/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

// Ang dashboard ay ang Bookings management page: table + Add/Edit/Delete
// na naka-modal (parehong controller/view ng /bookings, iisa lang ang laman).
Route::get('/dashboard', [BookingController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin pages (kailangan naka-login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Bookings module — index/store/update/destroy lang (single-page + modals, walang
    // hiwalay na create/edit/show page)
    Route::resource('bookings', BookingController::class)->only([
        'index', 'store', 'update', 'destroy',
    ]);

});

require base_path('routes/auth.php');
