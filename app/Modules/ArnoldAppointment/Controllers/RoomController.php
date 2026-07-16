<?php

namespace App\Modules\HotelManagement\Controllers;

use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function index()
    {
        return view('HotelManagement::index');
    }

    public function rooms()
    {
        return view('HotelManagement::rooms');
    }
}
