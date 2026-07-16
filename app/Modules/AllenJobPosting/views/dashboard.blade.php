<x-app-layout>
    <!-- Header Slot: This now acts as your Sub-Navigation -->
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Employer Dashboard') }}
            </h2>
            
            <!-- Sub-Navigation Actions -->
            <div class="flex items-center gap-3">
                <a href="{{ route('jobs.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium text-sm hover:bg-indigo-700 transition-colors shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Post a New Job
                </a>
                <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg font-medium text-sm hover:bg-gray-50 transition-colors shadow-sm">
                    View Public Job Board
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Main Content -->
    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Banner (Without duplicate buttons) -->
            <div class="bg-indigo-950 rounded-2xl shadow-sm border border-indigo-900 p-8 text-white">
                <h3 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name }}!</h3>
                <p class="mt-1.5 text-indigo-200/90">Manage your job listings and view insights from your dashboard.</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-xs font-semibold text-gray-400 uppercase">Active Postings</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ auth()->user()->jobs->count() }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Applicants</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">0</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Page Views</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">N/A</p>
                </div>
            </div>

            <!-- Job List Table -->
<div class="bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden mt-8">
    <div class="p-6 border-b border-gray-100">
        <h4 class="text-lg font-semibold text-gray-900">Your Active Job Posts</h4>
    </div>
    
    @if(auth()->user()->jobs->isEmpty())
        <div class="text-center py-16 text-gray-500">No job posts created yet.</div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase">Job Title</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase">Company</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase">Location</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach(auth()->user()->jobs as $job)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $job->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $job->company_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $job->location }}</td>
                            <td class="px-6 py-4 text-right text-sm">
                                <a href="{{ route('jobs.show', $job->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold underline">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
        </div>
    </div>
</x-app-layout>