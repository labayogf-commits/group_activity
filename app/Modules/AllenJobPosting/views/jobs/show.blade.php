<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('jobs.index') }}" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Job Details') }}
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">Explore the full role details and company description.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Content Area -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 space-y-6">
                        
                        <div class="border-b border-gray-100 pb-6">
                            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                                {{ $job->title }}
                            </h1>
                            <p class="text-md font-semibold text-indigo-600 mt-1">
                                {{ $job->company_name }}
                            </p>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">About the Role</h3>
                            <div class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">
                                {{ $job->description }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="space-y-6">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-6 sticky top-6">
                        <h3 class="text-sm font-bold text-gray-900 border-b border-gray-50 pb-3">Role Overview</h3>

                        <div class="space-y-4">
                            <!-- Location -->
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Location</p>
                                    <p class="text-sm font-semibold text-gray-800 mt-0.5">{{ $job->location }}</p>
                                </div>
                            </div>

                            <!-- Job Type -->
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-sky-50 text-sky-600 rounded-lg shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Job Type</p>
                                    <p class="text-sm font-semibold text-gray-800 mt-0.5">{{ $job->job_type ?? 'Not specified' }}</p>
                                </div>
                            </div>

                            <!-- Salary -->
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Salary Offer</p>
                                    <p class="text-sm font-semibold text-gray-800 mt-0.5">
                                        {{ $job->salary ? '₱ ' . number_format($job->salary, 2) : 'Not specified' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Date Posted -->
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-amber-50 text-amber-600 rounded-lg shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Posted On</p>
                                    <p class="text-sm font-semibold text-gray-800 mt-0.5">{{ $job->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-50">
                            <a href="{{ route('jobs.apply', $job->id) }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl transition duration-150 shadow-sm hover:shadow gap-2">
                                Apply for this job
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        </div>

                        @if(auth()->id() === $job->user_id)
                            <div class="flex gap-2 mt-4">
                                <a href="{{ route('jobs.edit', $job->id) }}" class="flex-1 text-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs rounded-lg transition">Edit</a>
                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 font-bold text-xs rounded-lg transition">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>