<?php

namespace App\Modules\ResortBooking\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['client', 'room'])
            ->latest()
            ->get();

        // Kailangan sa dropdown ng Add/Edit modal (Room lang, dahil type-in na
        // ang Client sa halip na dropdown)
        $rooms = Room::orderBy('room_number')->get();

        return view('bookings.index', compact('bookings', 'rooms'));
    }

    /**
     * I-save ang bagong booking (galing sa "Add Booking" modal).
     * Nire-reuse o ginagawa ang Client record base sa type-in na
     * Client Name / Email / Phone (hindi na kailangan mag-add ng Client
     * separately bago mag-book).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name'  => ['required', 'string', 'max:255'],
            'client_email' => ['required', 'email', 'max:255'],
            'client_phone' => ['required', 'string', 'max:30'],
            'room_id'      => ['required', 'exists:rooms,id'],
            'check_in'     => ['required', 'date'],
            'check_out'    => ['required', 'date', 'after:check_in'],
            'status'       => ['required', 'in:Pending,Confirmed,Cancelled'],
        ]);

        $client = Client::firstOrCreate(
            ['email' => $validated['client_email']],
            [
                'name'  => $validated['client_name'],
                'phone' => $validated['client_phone'],
            ]
        );

        Booking::create([
            'client_id' => $client->id,
            'room_id'   => $validated['room_id'],
            'check_in'  => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'status'    => $validated['status'],
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Na-add na ang bagong booking.');
    }

    /**
     * I-update ang existing booking (galing sa "Edit Booking" modal).
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'client_name'  => ['required', 'string', 'max:255'],
            'client_email' => ['required', 'email', 'max:255'],
            'client_phone' => ['required', 'string', 'max:30'],
            'room_id'      => ['required', 'exists:rooms,id'],
            'check_in'     => ['required', 'date'],
            'check_out'    => ['required', 'date', 'after:check_in'],
            'status'       => ['required', 'in:Pending,Confirmed,Cancelled'],
        ]);

        $client = Client::firstOrCreate(
            ['email' => $validated['client_email']],
            [
                'name'  => $validated['client_name'],
                'phone' => $validated['client_phone'],
            ]
        );

        // Kung mayroon nang client record, i-update ang pangalan/phone sa
        // pinaka-huling na-type sa form.
        $client->update([
            'name'  => $validated['client_name'],
            'phone' => $validated['client_phone'],
        ]);

        $booking->update([
            'client_id' => $client->id,
            'room_id'   => $validated['room_id'],
            'check_in'  => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'status'    => $validated['status'],
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Na-update ang booking.');
    }

    /**
     * Burahin ang booking.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Na-delete ang booking.');
    }
}