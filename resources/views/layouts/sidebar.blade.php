@php
    $sidebarTabs = \App\Helpers\SidebarHelper::getTabs();
@endphp

<div class="w-64 bg-white shadow-md min-h-screen hidden sm:block">
    <div class="p-4 border-b">
        <h2 class="text-xl font-bold text-gray-800">Menu</h2>
    </div>
    <nav class="p-4">
        <ul class="space-y-2">
            @foreach($sidebarTabs as $tab)
                @php
                    $url = Route::has($tab['route']) ? route($tab['route']) : url($tab['route']);
                    $isActive = request()->url() == $url;
                @endphp
                <li>
                    <a href="{{ $url }}" 
                       class="block px-4 py-2 rounded-md hover:bg-gray-100 transition-colors {{ $isActive ? 'bg-indigo-50 text-indigo-700 font-semibold border-l-4 border-indigo-500' : 'text-gray-600' }}">
                        {{ $tab['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</div>
