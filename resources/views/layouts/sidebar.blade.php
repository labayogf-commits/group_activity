@php
    $sidebarTabs = \App\Helpers\SidebarHelper::getTabs();
    $groupedTabs = collect($sidebarTabs)->groupBy('module');

    $currentRoute = Route::currentRouteName() ?? '';
    $filterModule = null;

    if (str_starts_with($currentRoute, 'arnold.')) {
        $filterModule = 'ArnoldAppointment';
    } elseif (request()->is('arnold/*')) {
        $filterModule = 'ArnoldAppointment';
    }

    if ($filterModule) {
        $groupedTabs = $groupedTabs->filter(fn($tabs, $module) => $module === $filterModule);
    }

    $sidebarIcons = [
        'calendar-icon' => '<svg class="h-4 w-4 text-slate-500 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>',
        'calendar-plus-icon' => '<svg class="h-4 w-4 text-slate-500 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M12 12v6m-3-3h6M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>',
    ];
@endphp

<div class="w-64 bg-white shadow-md min-h-screen hidden sm:block">
    <div class="p-4 border-b">
        <h2 class="text-xl font-bold text-gray-800">Menu</h2>
    </div>
    <nav class="p-4 space-y-4">
        @foreach($groupedTabs as $module => $tabs)
            <div class="space-y-2">
                <div class="px-4 py-2 text-xs font-semibold uppercase tracking-wide text-slate-400">
                    {{ \Illuminate\Support\Str::headline($module) }}
                </div>
                <ul class="space-y-2">
                    @foreach($tabs as $tab)
                        @php
                            $url = Route::has($tab['route']) ? route($tab['route']) : url($tab['route']);
                            $isActive = request()->url() == $url;
                            $iconMarkup = $sidebarIcons[$tab['icon']] ?? '';
                        @endphp
                        <li>
                            <a href="{{ $url }}"
                               class="flex items-center gap-2 px-4 py-2 rounded-md transition-colors {{ $isActive ? 'bg-indigo-50 text-indigo-700 font-semibold border-l-4 border-indigo-500' : 'text-gray-600 hover:bg-gray-100' }}">
                                {!! $iconMarkup !!}
                                <span>{{ $tab['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </nav>
</div>
