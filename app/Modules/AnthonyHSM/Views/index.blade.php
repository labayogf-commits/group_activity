<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50/50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCMAB CORE - Hardware Inventory System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full antialiased text-slate-800 font-sans">

    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-10 shadow-sm shadow-slate-100/40">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-br from-indigo-50 to-teal-50 text-indigo-600 p-2.5 rounded-xl border border-indigo-100 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="font-extrabold text-sm tracking-wider bg-gradient-to-r from-slate-900 to-indigo-950 bg-clip-text text-transparent uppercase">PCMAB CORE</span>
                        <span class="block text-[10px] font-mono text-indigo-600 uppercase tracking-widest font-bold leading-none mt-1">Sys-Admin Terminal</span>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <div class="hidden sm:flex items-center space-x-2 bg-emerald-50/50 px-3 py-1.5 rounded-full border border-emerald-100/50">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-emerald-700">Database Linked</span>
                    </div>

                    <div class="relative">
                        <button id="profileDropdownBtn" class="flex items-center space-x-2 focus:outline-none group">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold font-mono border-2 border-white shadow-md shadow-indigo-200 group-hover:scale-105 transition-all">
                                AD
                            </div>
                            <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                            </svg>
                        </button>

                        <div id="profileDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl border border-slate-200/80 shadow-lg shadow-slate-100 py-1.5 z-20 transition-all transform origin-top-right">
                            <div class="px-4 py-2 border-b border-slate-100">
                                <p class="text-[10px] font-mono font-bold uppercase tracking-widest text-slate-400">Current User</p>
                                <p class="text-xs font-bold text-slate-800">Sys-Administrator</p>
                            </div>
                            
                            <div class="px-4 py-2 text-xs text-slate-500 font-mono hover:bg-slate-50 cursor-default">
                                Role: Super Admin
                            </div>

                            <hr class="border-slate-100 my-1">

                            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                class="flex items-center space-x-2 w-full px-4 py-2 text-xs font-bold text-rose-600 hover:bg-rose-50/50 transition-colors text-left focus:outline-none">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"></path>
                                </svg>
                                <span>Terminate Session</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 sm:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-4">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sticky top-24">
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="text-xs font-mono text-indigo-600 font-bold bg-indigo-50 px-2 py-0.5 rounded-md border border-indigo-100/80">[01]</span>
                        <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900">Register Device</h3>
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed mb-6">Initialize and allocate new hardware assets into the central network registry.</p>
                    
                    <form action="/hardware-portal" method="POST" class="space-y-5">
                        @csrf
                        
                        <div>
                            <label class="block text-[10px] font-mono uppercase tracking-wider text-slate-500 mb-2">
                                Device Serial / MAC / ID / WINDOWS
                            </label>
                            <input type="text" name="asset_tag" required placeholder="e.g. HW-101"
                                class="w-full px-3.5 py-2.5 text-sm bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 focus:bg-white transition-all font-mono">
                            <span class="block text-[9px] text-slate-400 mt-1.5 leading-normal">
                                Code must be unique to map correct network routes.
                            </span>
                        </div>

                        <div>
                            <label class="block text-[10px] font-mono uppercase tracking-wider text-slate-500 mb-2">
                                Hardware Specification (Name)
                            </label>
                            <input type="text" name="name" required placeholder="e.g. MacBook Pro 16'' (M3 Max)"
                                class="w-full px-3.5 py-2.5 text-sm bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 focus:bg-white transition-all font-mono">
                        </div>

                        <button type="submit" 
                            class="w-full mt-2 bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 hover:from-indigo-900 hover:to-indigo-950 text-white font-bold uppercase tracking-widest py-3 px-4 rounded-xl text-[10px] transition-all duration-200 shadow-md shadow-indigo-950/10 hover:shadow-lg hover:shadow-indigo-950/20 active:scale-[0.98] font-mono">
                            EXECUTE REGISTER ➔
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-8">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/30">
                        <div class="flex items-center space-x-2">
                            <span class="text-xs font-mono text-indigo-600 font-bold bg-indigo-50 px-2 py-0.5 rounded-md border border-indigo-100/80">[02]</span>
                            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900">Core Network Registry</h3>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-mono uppercase tracking-wider bg-indigo-50/40 border border-indigo-100/50 text-indigo-700 font-bold shadow-sm">
                            {{ count($assets) }} NODE(S) ONLINE
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50/50 text-slate-500 text-[10px] font-mono uppercase tracking-wider">
                                    <th class="py-4 px-6 font-semibold">Hardware ID Code</th>
                                    <th class="py-4 px-6 font-semibold">Hardware Spec Name</th>
                                    <th class="py-4 px-6 text-right font-semibold">Operations</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($assets as $asset)
                                    <tr class="hover:bg-indigo-50/10 transition-colors group">
                                        <td class="py-4.5 px-6 text-sm font-mono font-bold tracking-wide">
                                            <span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md border border-blue-100/70 shadow-sm">
                                                {{ $asset->asset_tag }}
                                            </span>
                                        </td>
                                        <td class="py-4.5 px-6 text-sm text-slate-600 font-medium group-hover:text-slate-900 transition-colors">
                                            {{ $asset->name }}
                                        </td>
                                        <td class="py-4.5 px-6 text-sm text-right">
                                            <form action="/hardware-portal/{{ $asset->id }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Wipe this node from active database?')"
                                                    class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg border border-transparent hover:border-rose-100 hover:bg-rose-50 text-rose-600 hover:text-rose-700 font-mono text-[10px] font-bold uppercase tracking-widest transition-all">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    <span>Terminate</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-20 text-center text-sm font-mono text-slate-400">
                                            <span class="block mb-2 text-base">📁</span>
                                            // SYSTEM VACANT. NO REGISTERED NODES DISCOVERED.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownBtn = document.getElementById('profileDropdownBtn');
            const dropdownMenu = document.getElementById('profileDropdownMenu');

            dropdownBtn.addEventListener('click', function (event) {
                event.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function () {
                if (!dropdownMenu.classList.contains('hidden')) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>

</body>
</html>