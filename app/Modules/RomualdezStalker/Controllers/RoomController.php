<?php

namespace App\Modules\RomualdezStalker\Controllers;

use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function index()
    {
        // This will look for app/Modules/RomualdezStalker/Views/index.blade.php
        return view('RomualdezStalker::index'); 
    }
}
