<?php

namespace App\Modules\MedicineInventory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MedicineInventory\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
        public function index(Request $request)
    {
        $medicines = Medicine::orderBy('expiry_date', 'asc')->get();
        $editingMedicine = null;

        if ($request->has('edit')) {
            $editingMedicine = Medicine::find($request->edit);
        }

        $isAdd = $request->has('add');

    
        $categoryCounts = [
            'Tablet'    => Medicine::where('category', 'Tablet')->count(),
            'Capsule'   => Medicine::where('category', 'Capsule')->count(),
            'Syrup'     => Medicine::where('category', 'Syrup')->count(),
            'Ointment'  => Medicine::where('category', 'Ointment')->count(),
            'Injection' => Medicine::where('category', 'Injection')->count(),
        ];

        return view('MedicineInventory::index', compact('medicines', 'editingMedicine', 'categoryCounts', 'isAdd'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'expiry_date' => 'required|date|after_or_equal:today',
        ]);

        Medicine::create($validated);

        return redirect()->route('medicines.index')->with('success', 'Medical record added successfully!');
    }

    // Update an existing medicine
    public function update(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'expiry_date' => 'required|date',
        ]);

        $medicine->update($validated);

        return redirect()->route('medicines.index')->with('success', 'Medical record updated successfully!');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return redirect()->route('medicines.index')->with('success', 'Medical record deleted successfully!');
    }
}