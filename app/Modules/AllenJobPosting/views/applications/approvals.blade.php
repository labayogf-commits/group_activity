<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Approvals & Interviews') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Navigation -->
            <div class="flex items-center gap-8 border-b border-gray-200 mb-8">
                <a href="{{ route('applications.index') }}" 
                   class="pb-3 text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors">
                    My Applications
                </a>
                <a href="{{ route('applications.approvals') }}" 
                   class="pb-3 text-sm font-semibold text-indigo-600 border-b-2 border-indigo-600 transition-colors">
                    Application Approving & Interview Appointer
                </a>
            </div>

            <!-- Content -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Pending Approvals</h3>
                
                @if($applications->isEmpty())
                    <p class="text-gray-500">No applications waiting for approval.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-gray-400 text-xs uppercase font-bold border-b border-gray-100">
                                    <th class="pb-4">Applicant</th>
                                    <th class="pb-4">Job Title</th>
                                    <th class="pb-4">Status</th>
                                    <th class="pb-4">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
    @foreach($applications as $application)
        <tr>
            <td class="py-4">{{ $application->user->name }}</td>
            <td class="py-4">{{ $application->job->title }}</td>
            <td class="py-4">
                <span class="px-2 py-1 rounded text-xs font-bold {{ $application->status == 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                    {{ strtoupper($application->status) }}
                </span>
            </td>
            <td class="py-4">
                @if($application->status !== 'approved')
                    <form action="{{ route('applications.update', $application->id) }}" method="POST" class="flex items-center gap-2">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="approved">
                        
                        <!-- Date & Time Picker -->
                        <input type="datetime-local" name="interview_date" required 
                               class="text-xs border-gray-300 rounded-md">
                        
                        <button type="submit" class="text-indigo-600 font-bold hover:underline">Approve</button>
                    </form>
                @else
                    <span class="text-xs text-gray-500">
                        {{ $application->interview_date ? \Carbon\Carbon::parse($application->interview_date)->format('M d, Y - h:i A') : 'No Date Set' }}
                    </span>
                @endif
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