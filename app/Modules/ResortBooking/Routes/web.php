<?php

use Illuminate\Support\Facades\Route;
use App\Modules\HotelManagement\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Models\Room;


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

    // TODO: idagdag pa natin ito kapag ginawa na natin ang Rooms/Client/Calendar modules
    // Route::resource('rooms', RoomController::class)->only(['index', 'store', 'update', 'destroy']);
    // Route::resource('clients', ClientController::class)->only(['index', 'store', 'update', 'destroy']);
    // Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
});

require base_path('routes/auth.php');
