<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Applications') }}
        </h2>
        <p class="text-xs text-gray-500 mt-0.5">Track your submitted job applications, statuses, and scheduled interviews.</p>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Unified Navigation Tabs -->
            <div class="flex items-center gap-8 border-b border-gray-200 mb-8">
                <a href="{{ route('applications.index') }}" 
                   class="pb-3 text-sm {{ request()->routeIs('applications.index') ? 'font-semibold text-indigo-600 border-b-2 border-indigo-600' : 'font-medium text-gray-500 hover:text-indigo-600' }} transition-colors">
                    My Applications
                </a>
                <a href="{{ route('applications.approvals') }}" 
                   class="pb-3 text-sm {{ request()->routeIs('applications.approvals') ? 'font-semibold text-indigo-600 border-b-2 border-indigo-600' : 'font-medium text-gray-500 hover:text-indigo-600' }} transition-colors">
                    Application Approving & Interview Appointer
                </a>
            </div>
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-xl text-emerald-800 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                @if($applications->isEmpty())
                    <div class="text-center p-16">
                        <div class="w-12 h-12 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 text-sm font-medium">You haven't applied to any jobs yet.</p>
                        <a href="{{ route('jobs.index') }}" class="inline-flex items-center text-xs font-bold text-indigo-600 mt-3 hover:text-indigo-700">
                            Browse Open Roles →
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/75 border-b border-gray-100">
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Job Details</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Applied Date</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Interview Details</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($applications as $application)
                                    <tr class="hover:bg-gray-50/30 transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="font-bold text-gray-950 text-sm">{{ $application->job->title }}</div>
                                            <div class="text-xs text-gray-500 font-medium mt-0.5">{{ $application->job->company_name }}</div>
                                        </td>
                                        <td class="px-6 py-5 text-sm text-gray-500">
                                            {{ $application->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-5">
                                            @if($application->status === 'approved')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">Approved</span>
                                            @elseif($application->status === 'rejected')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-100">Rejected</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">Pending Review</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5">
                                            @if($application->interview_at)
                                                <div class="flex items-center gap-2">
                                                    <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                                                    <div>
                                                        <p class="text-xs font-bold text-gray-900">{{ $application->interview_at->format('M d, Y') }}</p>
                                                        <p class="text-[10px] font-medium text-gray-500">at {{ $application->interview_at->format('g:i A') }}</p>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-xs text-gray-400 italic">Not scheduled yet</span>
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