<?php

namespace App\Modules\MedicineInventory\Controllers;

use App\Http\Controllers\Controller;

class MedicineController extends Controller
{
    public function index()
    {
        return view('MedicineInventory::index');
    }

    public function create()
    {
        return view('MedicineInventory::create');
    }
}
