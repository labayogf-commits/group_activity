<x-app-layout>
    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Edit Job Posting</h2>
                
                <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Job Title</label>
                        <input type="text" name="title" value="{{ old('title', $job->title) }}" 
                               class="w-full mt-2 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Company & Location -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Company Name</label>
                            <input type="text" name="company_name" value="{{ old('company_name', $job->company_name) }}" 
                                   class="w-full mt-2 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Location</label>
                            <input type="text" name="location" value="{{ old('location', $job->location) }}" 
                                   class="w-full mt-2 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <!-- Salary -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Salary (PHP)</label>
                        <div class="relative mt-2">
                            <span class="absolute left-4 top-2.5 font-bold text-gray-500">₱</span>
                            <input type="number" name="salary" value="{{ old('salary', $job->salary) }}" 
                                   class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500">
                        </div>
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

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Description</label>
                        <textarea name="description" rows="4" 
                                  class="w-full mt-2 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500">{{ old('description', $job->description) }}</textarea>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition">
                            Update Job
                        </button>
                        <a href="{{ route('jobs.show', $job->id) }}" class="text-gray-500 hover:text-gray-900 font-medium">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>