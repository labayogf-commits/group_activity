<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <!-- Left Side: Title -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Employer Dashboard (Allen Gabriel S. Gaspar)') }}
            </h2>
            
            <!-- Right Side: Navigation Buttons -->
            <div class="flex items-center gap-3">
                <a href="{{ route('jobs.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Post a New Job
                </a>
                
            </div>
        </div>
    </x-slot>

    <!-- Rest of your code starts here (Line 2: <div class="py-12...>) -->
    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Hero Header Section -->
            <div class="text-center max-w-2xl mx-auto space-y-3 py-4">
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Discover Your Next Opportunity
                </h1>
                <p class="text-gray-500 text-sm sm:text-base">
                    Explore curated tech, design, and operations roles from leading employers.
                </p>
            </div>

            <!-- Search and Filter Bar -->
<form action="{{ route('jobs.index') }}" method="GET" class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row gap-3">
    <div class="flex-1 relative">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </span>
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Search by role title, keywords, or company..." 
            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200/80 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition duration-150 placeholder-gray-400"
        >
    </div>
    <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium text-sm transition shadow-sm">
        Search Jobs
    </button>
</form>

            <!-- Job Listings Grid -->
            <div class="space-y-4">
                @if($jobs->isEmpty())
                    <div class="text-center bg-white rounded-2xl border border-gray-100 p-16">
                        <div class="w-12 h-12 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 text-sm font-medium">No open positions right now.</p>
                        <p class="text-gray-400 text-xs mt-1">Check back later or explore other sections.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($jobs as $job)
                            <div class="group relative bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-indigo-100/80 transition-all duration-300 flex flex-col justify-between">
                                <div class="space-y-4">
                                    
                                    <!-- Card Header -->
                                    <div class="flex justify-between items-start gap-4">
                                        <div>
                                            <h3 class="font-bold text-gray-900 group-hover:text-indigo-600 transition-colors duration-150 text-lg">
                                                {{ $job->title }}
                                            </h3>
                                            <p class="text-sm text-gray-500 font-medium mt-0.5">{{ $job->company_name }}</p>
                                        </div>
                                        <div class="flex flex-col gap-2 items-end">
                                            <!-- Location Badge -->
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold uppercase bg-gray-100 text-gray-600 whitespace-nowrap">
                                                {{ $job->location }}
                                            </span>
                                            <!-- Job Type Badge -->
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold uppercase bg-indigo-50 text-indigo-700 border border-indigo-100/50 whitespace-nowrap">
                                                {{ $job->job_type ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>

                                    <p class="text-gray-500 text-sm line-clamp-2 leading-relaxed">
                                        {{ Str::limit($job->description, 140) }}
                                    </p>
                                </div>

                                <div class="flex items-center justify-between pt-6 mt-6 border-t border-gray-50">
                                    <div class="flex items-center gap-1.5 text-emerald-600">
                                        <span class="text-sm font-black">₱</span>
                                        <span class="text-xs font-bold tracking-tight">
                                            {{ $job->salary ? number_format($job->salary, 2) : 'Not specified' }}
                                        </span>
                                    </div>

                                    <a href="{{ route('jobs.show', $job->id) }}" class="inline-flex items-center text-xs font-bold text-gray-900 group-hover:text-indigo-600 transition-colors duration-150 gap-1">
                                        Details
                                        <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform duration-150" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>