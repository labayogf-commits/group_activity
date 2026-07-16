 <x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-slate-800 text-xl uppercase tracking-tight">SuriGastos</h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expenses Tracker by Patricia') }}
        </h2>
            <div class="flex items-center gap-6">
               
                <div class="text-right">
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Total Expenses</p>
                    <p class="text-lg font-black text-slate-900">₱ {{ number_format($totalExpenses, 2) }}</p>
                </div>
                
                <button onclick="document.getElementById('modal').classList.remove('hidden')" 
                        class="bg-emerald-600 text-white px-5 py-2 rounded-lg font-bold text-xs uppercase hover:bg-emerald-700 hover:scale-105 hover:shadow-lg transition-all duration-200">
                    + Add Expense
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-10 max-w-6xl mx-auto px-6">
        <!-- Date Filter -->
        <form method="GET" action="{{ route('expenses.index') }}" class="mb-8 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">From</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full p-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">To</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full p-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>
            <div class="flex items-center gap-2">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg font-bold transition">Filter</button>
                <a href="{{ route('expenses.index') }}" class="text-slate-400 hover:text-slate-600 font-bold px-4 py-3 transition">Clear</a>
            </div>
        </form>

        <!-- Table -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-[10px] uppercase text-slate-400">
                    <tr>
                        <th class="px-6 py-4">Item</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4 text-right">Amount</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($expenses as $expense)
                    <tr class="hover:bg-slate-50 transition-colors duration-200">
                        <td class="px-6 py-4 font-semibold text-slate-800">{{ $expense->item_name }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $expense->category }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $expense->date }}</td>
                        <td class="px-6 py-4 font-bold text-slate-900 text-right">₱ {{ number_format($expense->amount, 2) }}</td>
                        <td class="px-6 py-4 text-center flex justify-center gap-3">
                            <button onclick="openEditModal({{ $expense->id }}, '{{ $expense->item_name }}', {{ $expense->amount }}, '{{ $expense->category }}', '{{ $expense->date }}')" 
                                    class="text-blue-500 hover:text-blue-700 hover:scale-110 font-bold text-[10px] uppercase transition-all">Edit</button>
                            <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 hover:scale-110 font-bold text-[10px] uppercase transition-all">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-10 text-center text-slate-400">No records found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modals -->
    <div id="modal" class="hidden fixed inset-0 bg-slate-900/50 z-[100] flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h3 class="font-bold text-lg mb-4">Add Expense</h3>
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf
                <input type="text" name="item_name" placeholder="Item Name" class="w-full mb-3 p-3 border rounded-lg" required>
                <input type="number" name="amount" placeholder="Amount" class="w-full mb-3 p-3 border rounded-lg" required>
                <select name="category" class="w-full mb-3 p-3 border rounded-lg">
                    <option value="Food">Food</option><option value="Transport">Transport</option><option value="Bills">Bills</option>
                </select>
                <input type="date" name="date" class="w-full mb-4 p-3 border rounded-lg" required>
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 hover:shadow-lg text-white py-3 rounded-lg font-bold transition-all">Save</button>
                    <button type="button" onclick="document.getElementById('modal').classList.add('hidden')" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 py-3 rounded-lg font-bold transition-all">Back</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editModal" class="hidden fixed inset-0 bg-slate-900/50 z-[100] flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h3 class="font-bold text-lg mb-4">Edit Expense</h3>
            <form id="editForm" method="POST">
                @csrf @method('PATCH')
                <input type="text" name="item_name" id="edit_name" class="w-full mb-3 p-3 border rounded-lg" required>
                <input type="number" name="amount" id="edit_amount" class="w-full mb-3 p-3 border rounded-lg" required>
                <select name="category" id="edit_category" class="w-full mb-3 p-3 border rounded-lg">
                    <option value="Food">Food</option><option value="Transport">Transport</option><option value="Bills">Bills</option>
                </select>
                <input type="date" name="date" id="edit_date" class="w-full mb-4 p-3 border rounded-lg" required>
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 hover:shadow-lg text-white py-3 rounded-lg font-bold transition-all">Update</button>
                    <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 py-3 rounded-lg font-bold transition-all">Back</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, amount, cat, date) {
            const form = document.getElementById('editForm');
            form.action = '/expenses/' + id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_amount').value = amount;
            document.getElementById('edit_category').value = cat;
            document.getElementById('edit_date').value = date;
            document.getElementById('editModal').classList.remove('hidden');
        }
    </script>
</x-app-layout>