<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('jobs.show', $job->id) }}" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Submit Application') }}
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">Applying for: <strong class="text-gray-700">{{ $job->title }}</strong> at <span class="text-indigo-600 font-medium">{{ $job->company_name }}</span></p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <form action="{{ route('jobs.apply.submit', $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Success/Error Alert Banner (Optional) -->
                @if(session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-xl text-emerald-800 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 space-y-6">
                    <div class="border-b border-gray-100 pb-5">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <span class="p-1.5 bg-indigo-50 text-indigo-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </span>
                            Applicant Profile
                        </h3>
                        <p class="text-xs text-gray-400 mt-1">Review your details below before submitting.</p>
                    </div>

                    <!-- Readonly User Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Full Name</label>
                            <p class="text-sm font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-xl border border-gray-100">{{ auth()->user()->name }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Email Address</label>
                            <p class="text-sm font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-xl border border-gray-100">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-6 space-y-6">
                        <!-- Cover Letter / Pitch -->
                        <div class="space-y-1.5">
                            <label for="cover_letter" class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Cover Letter / Pitch</label>
                            <textarea 
                                name="cover_letter" 
                                id="cover_letter" 
                                rows="5"
                                placeholder="Tell us why you're a great fit for this role..."
                                class="w-full px-4 py-3.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition duration-150 placeholder-gray-400"
                                required
                            >{{ old('cover_letter') }}</textarea>
                            @error('cover_letter')
                                <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- File / Resume Upload -->
                        <div class="space-y-1.5">
                            <label for="resume" class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Upload Resume <span class="text-gray-400 font-normal">(PDF only)</span></label>
                            <div class="relative border-2 border-dashed border-gray-200 rounded-xl hover:border-indigo-400 transition-colors duration-150 bg-gray-50/30 p-6 text-center">
                                <input 
                                    type="file" 
                                    name="resume" 
                                    id="resume" 
                                    accept=".pdf"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    required
                                    onchange="document.getElementById('file-name').textContent = this.files[0] ? this.files[0].name : 'No file selected'"
                                >
                                <div class="space-y-2">
                                    <svg class="w-8 h-8 text-gray-400 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="text-sm font-medium text-gray-700">Click to upload, or drag & drop</p>
                                    <p class="text-xs text-gray-400">PDF formats up to 5MB</p>
                                    <p id="file-name" class="text-xs font-semibold text-indigo-600 pt-1"></p>
                                </div>
                            </div>
                            @error('resume')
                                <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Action Buttons -->
                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('jobs.show', $job->id) }}" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 rounded-xl font-medium text-sm hover:bg-gray-50 transition duration-150">
                        Cancel
                    </a>
                    <button 
                        type="submit" 
                        class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium text-sm transition duration-150 shadow-sm hover:shadow flex items-center gap-2"
                    >
                        Submit Application
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>