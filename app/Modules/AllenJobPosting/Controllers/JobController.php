<?php

namespace App\Modules\AllenJobPosting\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Start the query
    $query = Job::query();

    // If a search term exists, filter the results
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        
        $query->where(function($q) use ($searchTerm) {
            $q->where('title', 'like', '%' . $searchTerm . '%')
              ->orWhere('company_name', 'like', '%' . $searchTerm . '%')
              ->orWhere('description', 'like', '%' . $searchTerm . '%');
        });
    }

    // Get the jobs (latest first)
    $jobs = $query->latest()->get();

    return view('jobs.index', compact('jobs'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_type' => 'required|in:Full-time,Part-time,Hybrid', // Added validation
            'description' => 'required|string',
            'salary' => 'nullable|string|max:255',
            'apply_link' => 'nullable|url|max:255',
        ]);

        Auth::user()->jobs()->create($validated);

        return redirect()->route('jobs.index')->with('success', 'Job posted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job): View
    {
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the application form for a specific job.
     */
    public function apply(Job $job): View
    {
        return view('jobs.apply', compact('job'));
    }

    /**
     * Handle the submitted job application.
     */
    public function submitApplication(Request $request, Job $job): RedirectResponse
    {
        $request->validate([
            'cover_letter' => 'required|string|min:20',
            'resume' => 'required|file|mimes:pdf|max:5120',
        ]);

        $path = null;
        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes', 'public');
        }

        Application::create([
            'user_id' => Auth::id(),
            'job_id' => $job->id,
            'cover_letter' => $request->cover_letter,
            'resume_path' => $path,
        ]);

        return redirect()->route('applications.index')->with('success', 'Your application was submitted successfully!');
    }

    /**
     * List the applicant's submitted jobs
     */
    public function myApplications(): View
    {
        $applications = Auth::user()->applications()->with('job')->latest()->get();
        return view('applications.index', compact('applications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job): View
    {
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string',
            'location' => 'required|string',
            'job_type' => 'required|in:Full-time,Part-time,Hybrid', // Added update validation
            'salary' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $job->update($validated);

        return redirect()->route('jobs.show', $job->id)->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job): RedirectResponse
    {
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }
}