{{--
    _modal_fields.blade.php

    Shared fields na ginagamit ng "Add Booking" AT "Edit Booking" modal.
    Ginagamit ang $prefix (hal. "add_" o "edit_") para hindi magkasalungat
    ang id ng mga input kahit dalawang modal ang nasa parehong page.

    Kailangang variable pag ini-include ito:
    - $prefix    : string, hal. 'add_' o 'edit_'
    - $rooms     : collection ng Room
    - $booking   : Booking model (null kapag Add, may laman kapag Edit)
--}}

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="{{ $prefix }}client_name" class="form-label">Client Name</label>
        <input type="text" name="client_name" id="{{ $prefix }}client_name" class="form-control"
               value="{{ old('client_name', optional(optional($booking)->client)->name) }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="{{ $prefix }}client_phone" class="form-label">Phone</label>
        <input type="text" name="client_phone" id="{{ $prefix }}client_phone" class="form-control"
               value="{{ old('client_phone', optional(optional($booking)->client)->phone) }}" required>
    </div>
</div>

<div class="mb-3">
    <label for="{{ $prefix }}client_email" class="form-label">Email</label>
    <input type="email" name="client_email" id="{{ $prefix }}client_email" class="form-control"
           value="{{ old('client_email', optional(optional($booking)->client)->email) }}" required>
</div>


<div class="mb-3">
    <label for="{{ $prefix }}room_id" class="form-label">Room</label>
    <select name="room_id" id="{{ $prefix }}room_id" class="form-select" required>
        <option value="">-- Pumili ng Room --</option>
        @foreach ($rooms as $room)
            <option value="{{ $room->id }}"
                {{ optional($booking)->room_id == $room->id ? 'selected' : '' }}>
                {{ $room->room_number }} — {{ $room->type }} (₱{{ number_format($room->price_per_night, 2) }})
            </option>
        @endforeach
    </select>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="{{ $prefix }}check_in" class="form-label">Check-in</label>
        <input type="date" name="check_in" id="{{ $prefix }}check_in" class="form-control"
               value="{{ optional($booking)->check_in?->format('Y-m-d') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="{{ $prefix }}check_out" class="form-label">Check-out</label>
        <input type="date" name="check_out" id="{{ $prefix }}check_out" class="form-control"
               value="{{ optional($booking)->check_out?->format('Y-m-d') }}" required>
    </div>
</div>

<div class="mb-1">
    <label for="{{ $prefix }}status" class="form-label">Status</label>
    <select name="status" id="{{ $prefix }}status" class="form-select" required>
        @foreach (['Pending', 'Confirmed', 'Cancelled'] as $option)
            <option value="{{ $option }}"
                {{ optional($booking)->status === $option ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>
</div>