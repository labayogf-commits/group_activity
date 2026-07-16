<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Post a New Job') }}
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">Publish an open position to attract top talent.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <form action="{{ route('jobs.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Section 1: Basic Information -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 space-y-6">
                    <div class="border-b border-gray-100 pb-5">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <span class="p-1.5 bg-indigo-50 text-indigo-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </span>
                            Role Essentials
                        </h3>
                        <p class="text-xs text-gray-400 mt-1">Specify the core title and company details representing this opening.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Job Title -->
                        <div class="space-y-1.5 col-span-2 md:col-span-1">
                            <label for="title" class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Job Title</label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                value="{{ old('title') }}"
                                placeholder="e.g. Senior Full-Stack Engineer"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition duration-150 placeholder-gray-400"
                                required
                            >
                            @error('title')
                                <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Company Name -->
                        <div class="space-y-1.5 col-span-2 md:col-span-1">
                            <label for="company_name" class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Company Name</label>
                            <input 
                                type="text" 
                                name="company_name" 
                                id="company_name" 
                                value="{{ old('company_name') }}"
                                placeholder="e.g. Acme Corp"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition duration-150 placeholder-gray-400"
                                required
                            >
                            @error('company_name')
                                <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 2: Position Details & Compensation -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 space-y-6">
                    <div class="border-b border-gray-100 pb-5">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <span class="p-1.5 bg-emerald-50 text-emerald-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </span>
                            Location & Compensation
                        </h3>
                        <p class="text-xs text-gray-400 mt-1">Define geographical coordinates or remote setups along with remuneration ranges.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Location -->
                        <div class="space-y-1.5">
                            <label for="location" class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Location</label>
                            <input 
                                type="text" 
                                name="location" 
                                id="location" 
                                value="{{ old('location') }}"
                                placeholder="e.g. Remote / New York, NY"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-100 focus:border-emerald-500 transition duration-150 placeholder-gray-400"
                                required
                            >
                            @error('location')
                                <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Salary / Budget -->
                        <div class="space-y-1.5">
                            <label for="salary" class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Salary Range <span class="text-gray-400 font-normal">(Optional)</span></label>
                            <input 
                                type="text" 
                                name="salary" 
                                id="salary" 
                                value="{{ old('salary') }}"
                                placeholder="e.g. $120k - $140k"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-100 focus:border-emerald-500 transition duration-150 placeholder-gray-400"
                            >
                            @error('salary')
                                <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
    <label class="block text-sm font-medium text-gray-700">Job Type</label>
    <select name="job_type" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
        <option value="" disabled selected>Select job type</option>
        <option value="Full-time" {{ (isset($job) && $job->job_type == 'Full-time') ? 'selected' : '' }}>Full-time</option>
        <option value="Part-time" {{ (isset($job) && $job->job_type == 'Part-time') ? 'selected' : '' }}>Part-time</option>
        <option value="Hybrid" {{ (isset($job) && $job->job_type == 'Hybrid') ? 'selected' : '' }}>Hybrid</option>
    </select>
</div>
                    </div>
                </div>

                <!-- Section 3: Job Description -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 space-y-6">
                    <div class="border-b border-gray-100 pb-5">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <span class="p-1.5 bg-amber-50 text-amber-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                            </span>
                            Role Description
                        </h3>
                        <p class="text-xs text-gray-400 mt-1">Present expectations, responsibilities, requirements, and daily impact.</p>
                    </div>

                    <!-- Description Textarea -->
                    <div class="space-y-1.5">
                        <label for="description" class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            rows="6"
                            placeholder="We are looking for a software architect to help scale our cloud infrastructure. In this role, you will..."
                            class="w-full px-4 py-3.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 transition duration-150 placeholder-gray-400"
                            required
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Submitting Actions -->
                <div class="flex items-center justify-end gap-3 pt-4">
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 rounded-xl font-medium text-sm hover:bg-gray-50 transition duration-150">
                        Cancel
                    </a>
                    <button 
                        type="submit" 
                        class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium text-sm transition duration-150 shadow-sm hover:shadow flex items-center gap-2"
                    >
                        Publish Post
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>