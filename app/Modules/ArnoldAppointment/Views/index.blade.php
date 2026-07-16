
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Appointments</h2>
    </x-slot>

    <div class="flex min-h-screen bg-slate-50 font-sans" 
         x-data="{ 
            openModal: false, 
            isEditing: false,
            showAddCandidate: false,
            isSidebarMinimized: false,
            actionUrl: '{{ route('interviews.store') }}',
            
            // Form Bindings
            candidateId: '',
            jobPositionId: '',
            interviewTypeId: '',
            date: '2026-01-23',
            time: '10:00',

            // Candidate Bindings
            newCandidateName: '',
            newCandidateEmail: '',
            newCandidateGithub: '',

            openScheduleModal() {
                this.isEditing = false;
                this.showAddCandidate = false;
                this.actionUrl = '{{ route('interviews.store') }}';
                this.candidateId = '';
                this.jobPositionId = '';
                this.interviewTypeId = '';
                this.date = '2026-01-23';
                this.time = '10:00';
                this.openModal = true;
            },

            openEditModal(interview) {
                this.isEditing = true;
                this.showAddCandidate = false;
                this.actionUrl = '/dashboard/interview/' + interview.id;
                this.candidateId = interview.candidate_id;
                this.jobPositionId = interview.job_position_id;
                this.interviewTypeId = interview.interview_type_id;
                
                // Separate start_at string into date and time format
                let dt = interview.start_at.split(' ');
                this.date = dt[0];
                this.time = dt[1].substring(0, 5); // Pick HH:MM
                
                this.openModal = true;
            }
         }">
        
        <!-- SIDEBAR (Left Navigation) -->
        <aside :class="isSidebarMinimized ? 'w-16' : 'w-64'" class="bg-white border-r border-slate-200 flex flex-col justify-between hidden md:flex transition-all duration-300 overflow-hidden">
            <div class="space-y-6">
                <div class="flex items-center justify-between px-4">
                    <span x-show="!isSidebarMinimized" class="text-sm font-semibold text-slate-700">Menu</span>
                    <button @click="isSidebarMinimized = !isSidebarMinimized" class="text-slate-500 hover:text-slate-800 rounded-lg p-2">
                        <span x-text="isSidebarMinimized ? '>' : '<'"></span>
                    </button>
                </div>

                <!-- Navigation Links -->
                <nav class="space-y-6 px-4" :class="isSidebarMinimized ? 'px-2' : 'px-4'">
                    <div>
                        <div x-show="!isSidebarMinimized" class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Recruitment Pipeline</div>
                        <div class="mt-2 space-y-1">
                            <a href="#" :class="isSidebarMinimized ? 'justify-center px-2 py-3' : 'flex items-center px-4 py-2'" class="flex text-sm font-medium text-slate-600 hover:bg-slate-50 rounded-xl transition-all duration-200">
                                <span :class="isSidebarMinimized ? 'text-lg' : 'mr-3'">📊</span>
                                <span x-show="!isSidebarMinimized">Dashboard Overview</span>
                            </a>
                            <a href="#" :class="isSidebarMinimized ? 'justify-center px-2 py-3' : 'flex items-center px-4 py-2'" class="flex text-sm font-medium text-indigo-600 bg-indigo-50 rounded-xl transition-all duration-200">
                                <span :class="isSidebarMinimized ? 'text-lg' : 'mr-3'">📅</span>
                                <span x-show="!isSidebarMinimized">Interview Schedule</span>
                            </a>
                            <a href="#" :class="isSidebarMinimized ? 'justify-center px-2 py-3' : 'flex items-center px-4 py-2'" class="flex text-sm font-medium text-slate-600 hover:bg-slate-50 rounded-xl transition-all duration-200">
                                <span :class="isSidebarMinimized ? 'text-lg' : 'mr-3'">👥</span>
                                <span x-show="!isSidebarMinimized">Active Candidates</span>
                            </a>
                        </div>
                    </div>

                    <div>
                        <div x-show="!isSidebarMinimized" class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Job Management</div>
                        <div class="mt-2 space-y-1">
                            <a href="#" :class="isSidebarMinimized ? 'justify-center px-2 py-3' : 'flex items-center px-4 py-2'" class="flex text-sm font-medium text-slate-600 hover:bg-slate-50 rounded-xl transition-all duration-200">
                                <span :class="isSidebarMinimized ? 'text-lg' : 'mr-3'">💼</span>
                                <span x-show="!isSidebarMinimized">Job Openings</span>
                            </a>
                            <a href="#" :class="isSidebarMinimized ? 'justify-center px-2 py-3' : 'flex items-center px-4 py-2'" class="flex text-sm font-medium text-slate-600 hover:bg-slate-50 rounded-xl transition-all duration-200">
                                <span :class="isSidebarMinimized ? 'text-lg' : 'mr-3'">🛡️</span>
                                <span x-show="!isSidebarMinimized">Interviewers Panel</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            
            <div class="pt-6 border-t border-slate-200 flex justify-between text-xs text-slate-400 px-4">
                <button x-show="!isSidebarMinimized" class="hover:text-slate-800">⚙️ Settings</button>
                <button x-show="!isSidebarMinimized" class="hover:text-slate-800">📄 Export</button>
            </div>
        </aside>

        <!-- MAIN SCHEDULER BOARD -->
        <main class="flex-1 p-6 space-y-6 overflow-y-auto">
            
            <!-- Calendar Context Controls Bar -->
            <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <button class="px-3 py-1.5 bg-slate-100 text-xs font-semibold rounded-lg text-slate-700">Today</button>
                    <div class="flex items-center space-x-2">
                        <button class="p-1 text-slate-400 hover:text-slate-600 text-xs">◀</button>
                        <span class="text-sm font-bold text-slate-800">January 2026</span>
                        <button class="p-1 text-slate-400 hover:text-slate-600 text-xs">▶</button>
                    </div>
                </div>

                <div class="flex items-center justify-between sm:justify-end gap-3">
                    <div class="inline-flex rounded-xl border border-slate-200 bg-white p-1">
                        <button class="px-3 py-1 text-xs font-medium text-slate-500 rounded-lg">Day</button>
                        <button class="px-3 py-1 text-xs font-medium text-indigo-600 bg-indigo-50 rounded-lg">Week</button>
                        <button class="px-3 py-1 text-xs font-medium text-slate-500 rounded-lg">Month</button>
                    </div>

                    <button @click="openScheduleModal()" class="px-4 py-2 bg-indigo-600 text-white text-xs font-semibold rounded-xl hover:bg-indigo-700 transition shadow-sm">
                        + Schedule Interview
                    </button>
                </div>
            </div>

            <!-- 1. HR PIPELINE METRICS GRID -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Interviews Scheduled</p>
                    <div class="mt-2 flex items-baseline justify-between">
                        <span class="text-2xl font-black text-slate-800">{{ $stats['scheduled'] }}</span>
                        <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">+8%</span>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Completion Rate</p>
                    <div class="mt-2 flex items-baseline justify-between">
                        <span class="text-2xl font-black text-slate-800">{{ $stats['completion_rate'] }}</span>
                        <span class="text-[10px] font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full">Stable</span>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Candidate No-Shows</p>
                    <div class="mt-2 flex items-baseline justify-between">
                        <span class="text-2xl font-black text-slate-800">{{ $stats['no_show_rate'] }}</span>
                        <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">-3%</span>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Avg. Feedback Time</p>
                    <div class="mt-2 flex items-baseline justify-between">
                        <span class="text-2xl font-black text-slate-800">{{ $stats['feedback_time'] }}</span>
                        <span class="text-[10px] font-bold text-rose-600 bg-rose-50 px-2 py-0.5 rounded-full">+1.1h</span>
                    </div>
                </div>
            </div>

            <!-- 2. WEEK CALENDAR TIMELINE -->
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                <!-- Calendar Grid Days Header -->
                <div class="grid grid-cols-6 border-b border-slate-200 bg-slate-50 text-center py-3 text-xs font-bold text-slate-500">
                    <div class="border-r border-slate-200">Time Window</div>
                    <div class="border-r border-slate-200">Mon 22</div>
                    <div class="border-r border-slate-200 text-indigo-600 bg-indigo-50/30">Tue 23 (Today)</div>
                    <div class="border-r border-slate-200">Wed 24</div>
                    <div class="border-r border-slate-200">Thu 25</div>
                    <div>Fri 26</div>
                </div>

                <!-- Calendar Content Columns -->
                <div class="grid grid-cols-6 divide-x divide-slate-100 h-[400px] overflow-y-auto bg-white">
                    <!-- Time Labels Column -->
                    <div class="p-4 text-center text-[10px] font-bold text-slate-400 space-y-12">
                        <div>09:00 AM</div>
                        <div>11:00 AM</div>
                        <div>01:00 PM</div>
                        <div>03:00 PM</div>
                    </div>

                    <!-- Calendar Day Cards -->
                    @foreach (['Mon', 'Tue', 'Wed', 'Thu', 'Fri'] as $day)
                        <div class="p-2 space-y-2 {{ $day == 'Tue' ? 'bg-indigo-50/10' : 'bg-slate-50/30' }}">
                            @foreach ($calendar[$day] as $interview)
                                @php
                                    $colorMap = [
                                        'blue' => ['bg' => 'bg-blue-50', 'border' => 'border-blue-500', 'text' => 'text-blue-900', 'sub' => 'text-blue-800'],
                                        'indigo' => ['bg' => 'bg-indigo-50', 'border' => 'border-indigo-600', 'text' => 'text-indigo-900', 'sub' => 'text-indigo-800'],
                                        'emerald' => ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-500', 'text' => 'text-emerald-900', 'sub' => 'text-emerald-800'],
                                        'purple' => ['bg' => 'bg-purple-50', 'border' => 'border-purple-500', 'text' => 'text-purple-900', 'sub' => 'text-purple-800'],
                                    ];
                                    $theme = $colorMap[$interview->color_code] ?? $colorMap['indigo'];
                                @endphp
                                <div @click="openEditModal({{ json_encode($interview) }})" 
                                     class="cursor-pointer transition hover:scale-[1.02] active:scale-95 {{ $theme['bg'] }} border-l-4 {{ $theme['border'] }} rounded-xl p-2.5 text-xs shadow-xs">
                                    <p class="font-bold {{ $theme['text'] }}">
                                        {{ \Carbon\Carbon::parse($interview->start_at)->format('h:i A') }}
                                    </p>
                                    <p class="font-semibold {{ $theme['sub'] }} truncate">{{ $interview->stage_name }}: {{ $interview->candidate_name }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </main>

        <!-- 3. INTERACTIVE POPUP MODAL (Both Creation & Editing Supported) -->
        <div x-show="openModal" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs"
             style="display: none;">
            
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden" @click.away="openModal = false">
                <div class="bg-indigo-600 text-white p-4 flex justify-between items-center">
                    <h3 class="font-bold text-xs tracking-wide uppercase" x-text="isEditing ? 'Reschedule Interview' : 'New Interview Booking'"></h3>
                    <button @click="openModal = false" class="text-white hover:text-slate-200 text-xl font-bold">&times;</button>
                </div>

                <form class="p-6 space-y-4" method="POST" :action="actionUrl">
                    @csrf
                    <!-- Dynamic form spoofing for Laravel REST methods -->
                    <template x-if="isEditing">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <!-- Dynamic Candidate Input Layout -->
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider">Candidate</label>
                            
                            <!-- Toggle link to trigger Candidate Creation (Only available when creating new records) -->
                            <button type="button" 
                                    x-show="!isEditing"
                                    @click="showAddCandidate = !showAddCandidate" 
                                    class="text-[9px] font-extrabold text-indigo-600 hover:text-indigo-800 uppercase tracking-wider">
                                <span x-text="showAddCandidate ? '← Use Existing' : '+ Quick Add New'"></span>
                            </button>
                        </div>

                        <!-- 1. Existing Candidate Dropdown -->
                        <div x-show="!showAddCandidate">
                            <select name="candidate_id" x-model="candidateId" :required="!showAddCandidate" class="w-full p-2.5 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                <option value="">Select Candidate...</option>
                                @forelse ($candidates as $candidate)
                                    <option value="{{ $candidate->id }}">{{ $candidate->name }} (GitHub: {{ $candidate->github_handle }})</option>
                                @empty
                                    <option value="" disabled>No candidates available. Use + Quick Add New.</option>
                                @endforelse
                            </select>
                        </div>

                        <!-- 2. Inline Creation Form Fields -->
                        <div x-show="showAddCandidate" class="space-y-3 bg-slate-50 border border-slate-100 p-3 rounded-xl">
                            <div>
                                <label class="block text-[9px] font-bold text-slate-400 uppercase">Full Name</label>
                                <input type="text" name="new_candidate_name" :required="showAddCandidate" x-model="newCandidateName" placeholder="e.g. Jane Doe" class="mt-1 w-full p-2 border border-slate-200 rounded-lg text-xs focus:ring-1 focus:ring-indigo-500 focus:outline-none">
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-[9px] font-bold text-slate-400 uppercase">Email Address</label>
                                    <input type="email" name="new_candidate_email" :required="showAddCandidate" x-model="newCandidateEmail" placeholder="jane@example.com" class="mt-1 w-full p-2 border border-slate-200 rounded-lg text-xs focus:ring-1 focus:ring-indigo-500 focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-[9px] font-bold text-slate-400 uppercase">GitHub Handle</label>
                                    <input type="text" name="new_candidate_github" x-model="newCandidateGithub" placeholder="janedoe" class="mt-1 w-full p-2 border border-slate-200 rounded-lg text-xs focus:ring-1 focus:ring-indigo-500 focus:outline-none">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider">Target Job Opening</label>
                        <select name="job_position_id" x-model="jobPositionId" required class="mt-1 w-full p-2.5 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            <option value="">Select Job Position...</option>
                            @forelse ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->title }}</option>
                            @empty
                                <option value="" disabled>No positions available.</option>
                            @endforelse
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider">Interview Stage</label>
                        <select name="interview_type_id" x-model="interviewTypeId" required class="mt-1 w-full p-2.5 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            <option value="">Select Stage...</option>
                            @forelse ($stages as $stage)
                                <option value="{{ $stage->id }}">{{ $stage->stage_name }}</option>
                            @empty
                                <option value="" disabled>No stages available.</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider">Date</label>
                            <input type="date" name="date" x-model="date" required class="mt-1 w-full p-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider">Time</label>
                            <input type="time" name="time" x-model="time" required class="mt-1 w-full p-2 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2 pt-2">
                        <button type="button" @click="openModal = false" class="px-4 py-2 border border-slate-200 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50">Dismiss</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-semibold hover:bg-indigo-700 shadow-sm" x-text="isEditing ? 'Save Changes' : 'Confirm'"></button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>