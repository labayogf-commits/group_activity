<?php

namespace App\Modules\ExpensesTracker\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ExpensesTracker\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        // Simulan ang query para sa kasalukuyang user
        $query = Expense::where('user_id', Auth::id());

        // Kung may piniling petsa sa filter, i-apply ang whereBetween
        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $expenses = $query->latest()->get();
        $totalExpenses = $expenses->sum('amount');

        return view('expenses::index', compact('expenses', 'totalExpenses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string',
            'date' => 'required|date',
        ]);

        Auth::user()->expenses()->create($validated);
        return back()->with('success', 'Expense added successfully!');
    }

    public function update(Request $request, Expense $expense)
    {
        // Siguraduhin na ang user lang na may-ari ang makakapag-edit
        if ($expense->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string',
            'date' => 'required|date',
        ]);

        $expense->update($validated);
        return back()->with('success', 'Expense updated successfully!');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->user_id !== Auth::id()) {
            abort(403);
        }
        
        $expense->delete();
        return back()->with('success', 'Expense deleted successfully!');
    }
}