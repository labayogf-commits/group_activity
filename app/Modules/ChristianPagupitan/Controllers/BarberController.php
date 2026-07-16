<?php

namespace App\Modules\ChristianPagupitan\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ChristianPagupitan\Models\BarberItem;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    // 1. Read All Items from Database
    public function index()
{
    $items = BarberItem::all();

    $totalBarbers = BarberItem::where('category', 'Barber')->count();

    $totalStyles = BarberItem::where('category', 'Haircut')->count();

    $totalPending = 0;

    return view('ChristianPagupitan::index', [
        'items' => $items,
        'totalBarbers' => $totalBarbers,
        'totalStyles' => $totalStyles,
        'totalPending' => $totalPending,
    ]);
}

    // 2. Create/Store New Item in Database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category' => 'required|string',
        ]);

        BarberItem::create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
        ]);

        return redirect()->route('barber.index')->with('success', 'Service added successfully!');
    }

    // 3. Update/Edit Existing Item in Database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category' => 'required|string',
        ]);

        $item = BarberItem::findOrFail($id);
        $item->update([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
        ]);

        return redirect()->route('barber.index')->with('success', 'Service updated successfully!');
    }

    // 4. Destroy/Delete Item from Database
    public function destroy($id)
    {
        $item = BarberItem::findOrFail($id);
        $item->delete();

        return redirect()->route('barber.index')->with('success', 'Service deleted successfully!');
    }
}