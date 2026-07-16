<?php

namespace App\Modules\AllenJobPosting\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application; // Make sure this is imported
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    // ... your other methods (index, etc.) might be here ...

    public function approvals()
    {
        // Fetch applications to show in your table
        $applications = Application::all(); 
        
        return view('applications.approvals', compact('applications'));
    }

    public function update(Request $request, Application $application)
{
    $validated = $request->validate([
        'status' => 'required|in:approved,rejected',
        'interview_date' => 'nullable|date', // Validate the date
    ]);

    $application->update([
        'status' => $request->status,
        'interview_date' => $request->interview_date,
    ]);

    return back()->with('success', 'Application updated!');
}
}