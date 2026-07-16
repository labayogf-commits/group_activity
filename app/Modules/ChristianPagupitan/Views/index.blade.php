
<x-app-layout>
    <div x-data="{
        open: false,
        editMode: false,
        itemId: null,
        name: '',
        price: '',
        category: 'haircut'
    }" class="min-h-screen bg-slate-50/80 py-8 px-4 sm:px-6 lg:px-8 font-sans antialiased">

        <div class="max-w-7xl mx-auto space-y-8">
            
            <div class="relative overflow-hidden bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 transition-all duration-300 hover:shadow-md">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-50 rounded-full blur-3xl opacity-60"></div>
                <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-sky-50 rounded-full blur-3xl opacity-60"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center gap-3">
                        <span class="text-3xl animate-pulse">💈</span>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-950 tracking-tight">
                            Barber Shop Dashboard
                        </h1>
                    </div>
                </div>
                
                <button @click="open=true; editMode=false; name=''; price=''; category='haircut';" class="relative z-10 w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white px-6 py-3.5 rounded-2xl font-semibold shadow-lg shadow-indigo-100 transition-all duration-200 transform active:scale-95 group text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-100 group-hover:rotate-90 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add New Service
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-between group hover:shadow-md transition-all duration-300">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Barbers</p>
                        <h3 class="text-3xl font-black text-slate-900 tracking-tight group-hover:text-indigo-600 transition-colors">{{ $totalBarbers ?? 0 }}</h3>
                    </div>
                    <div class="p-4 bg-indigo-50/60 text-indigo-600 rounded-2xl group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-between group hover:shadow-md transition-all duration-300">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Haircut Styles</p>
                        <h3 class="text-3xl font-black text-slate-900 tracking-tight group-hover:text-emerald-600 transition-colors">{{ $totalStyles ?? 0 }}</h3>
                    </div>
                    <div class="p-4 bg-emerald-50/60 text-emerald-600 rounded-2xl group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 11-4.243-4.243 3 3 0 014.243 4.243z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-between group hover:shadow-md transition-all duration-300">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Pending Appts</p>
                        <h3 class="text-3xl font-black text-slate-900 tracking-tight group-hover:text-amber-600 transition-colors">{{ $totalPending ?? 0 }}</h3>
                    </div>
                    <div class="p-4 bg-amber-50/60 text-amber-600 rounded-2xl group-hover:bg-amber-600 group-hover:text-white transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span>📋</span> Active Catalog Services
                    </h2>
                    <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-3 py-1 rounded-full">
                        {{ count($items ?? []) }} {{ Str::plural('Item', count($items ?? [])) }}
                    </span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th scope="col" class="py-4 px-6 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Service Name</th>
                                <th scope="col" class="py-4 px-6 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Category Type</th>
                                <th scope="col" class="py-4 px-6 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Price Rate</th>
                                <th scope="col" class="py-4 px-6 text-center text-xs font-bold text-slate-400 uppercase tracking-wider">Action Commands</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($items ?? [] as $item)
                            <tr class="hover:bg-slate-50/40 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-900">
                                    {{ $item->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($item->category === 'haircut')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100/80">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            {{ ucfirst($item->category) }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100/80">
                                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                            {{ ucfirst($item->category) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-extrabold text-slate-800">
                                    ${{ number_format($item->price, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <button @click="open=true; editMode=true; itemId={{ $item->id }}; name='{{ addslashes($item->name) }}'; price='{{ $item->price }}'; category='{{ $item->category }}';" class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100/80 px-3.5 py-2 rounded-xl font-bold transition-all duration-150 text-xs active:scale-95">
                                            Edit
                                        </button>
                                        <form action="{{ \Illuminate\Support\Facades\Route::has('items.destroy') ? route('items.destroy', $item->id) : '/items/' . $item->id }}" method="POST" class="inline-block">
                                            @csrf @method('DELETE')
                                            <button onclick="return confirm('Are you sure you want to delete this option?')" class="inline-flex items-center gap-1 text-rose-600 hover:text-rose-950 bg-rose-50 hover:bg-rose-100/80 px-3.5 py-2 rounded-xl font-bold transition-all duration-150 text-xs active:scale-95">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center">
                                    <div class="max-w-md mx-auto flex flex-col items-center justify-center gap-4">
                                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center text-2xl shadow-inner">
                                            📭
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-slate-800 text-base">No Items Found</h3>
                                            <p class="text-xs text-slate-400 mt-1 max-w-xs">Your shop catalog is currently empty. Click the "Add New Service" button to start creating products!</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-950/40 backdrop-blur-md flex justify-end z-[100]">
                
                <div @click.outside="open=false" 
                     x-show="open"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="translate-x-full"
                     class="bg-white w-full max-w-md h-full shadow-2xl flex flex-col border-l border-slate-100 relative">
                    
                    <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                        <div>
                            <h2 class="text-lg font-black text-slate-900" x-text="editMode ? 'Modify Catalog Service' : 'Create Catalog Service'"></h2>
                            <p class="text-xs text-slate-400 font-medium mt-1">Submit the catalog information details below.</p>
                        </div>
                        <button @click="open=false" class="text-slate-400 hover:text-slate-600 p-2 hover:bg-slate-200/50 rounded-xl transition-all duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form :action="editMode ? '/items/' + itemId : '{{ \Illuminate\Support\Facades\Route::has('items.store') ? route('items.store') : '/items' }}'" method="POST" class="p-6 flex-1 flex flex-col justify-between overflow-y-auto space-y-6">
                        @csrf
                        <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>
                        
                        <div class="space-y-5">
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Service/Item Name</label>
                                <input x-model="name" name="name" type="text" required placeholder="e.g., Mid Skin Fade" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 font-medium placeholder-slate-400 transition-all shadow-sm">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Price Rate ($)</label>
                                <div class="relative rounded-xl shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="text-slate-400 text-sm font-bold">$</span>
                                    </div>
                                    <input x-model="price" name="price" type="number" step="0.01" required placeholder="0.00" class="w-full border border-slate-200 rounded-xl pl-8 pr-4 py-3 text-sm focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 font-bold placeholder-slate-400 transition-all">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Category Selection</label>
                                <select x-model="category" name="category" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 font-bold bg-white transition-all shadow-sm">
                                    <option value="haircut">💇‍♂️ Haircut Style</option>
                                    <option value="barber">💈 Barber Shop Product</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-100 flex items-center gap-3 bg-white">
                            <button type="button" @click="open=false" class="flex-1 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 py-3.5 rounded-xl font-bold text-sm transition-all duration-150 active:scale-95">
                                Cancel
                            </button>
                            <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white py-3.5 rounded-xl font-bold text-sm transition-all duration-150 shadow-lg shadow-indigo-100 active:scale-95">
                                Save Details
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>