<x-app-layout>
    <main class="mx-auto grid max-w-7xl gap-6 p-6 lg:grid-cols-[360px_1fr]">
        {{-- Add Client Section --}}
        <section class="h-fit rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 id="form-title" class="text-xl font-bold">Add New Client</h2>
                    <p class="text-sm text-slate-500">Enter the client information below.</p>
                </div>
                <span class="rounded-full bg-cyan-100 px-3 py-1 text-sm font-semibold text-cyan-700">{{ $clients->count() }} clients</span>
            </div>

            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">{{ $errors->first() }}</div>
            @endif

            <form id="client-form" action="{{ route('clients.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="mb-1 block text-sm font-semibold">First Name</label>
                    <input id="first_name" name="first_name" value="{{ old('first_name') }}" required class="w-full rounded-lg border-slate-300 px-3 py-2.5 focus:border-cyan-500 focus:ring-cyan-500" placeholder="Juan">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold">Last Name</label>
                    <input id="last_name" name="last_name" value="{{ old('last_name') }}" required class="w-full rounded-lg border-slate-300 px-3 py-2.5 focus:border-cyan-500 focus:ring-cyan-500" placeholder="Dela Cruz">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold">Phone Number</label>
                    <input id="phone" name="phone" value="{{ old('phone') }}" required class="w-full rounded-lg border-slate-300 px-3 py-2.5 focus:border-cyan-500 focus:ring-cyan-500" placeholder="09171234567">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-lg border-slate-300 px-3 py-2.5 focus:border-cyan-500 focus:ring-cyan-500" placeholder="juan@email.com">
                </div>
                <div class="flex gap-3 pt-2">
                    <button id="submit-button" class="flex-1 rounded-lg bg-cyan-600 px-4 py-2.5 font-semibold text-white shadow-sm hover:bg-cyan-700">Add Client</button>
                    <button id="clear-button" type="button" class="rounded-lg border border-slate-300 px-4 py-2.5 font-semibold text-slate-600 hover:bg-slate-50">Clear</button>
                </div>
            </form>
        </section>

        {{-- Client Directory Section --}}
        <section class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">
                <div><h2 class="text-xl font-bold">Client Directory</h2><p class="text-sm text-slate-500">Select Edit to load a client into the form.</p></div>
                @if (session('success'))<span class="rounded-lg bg-emerald-50 px-3 py-2 text-sm font-medium text-emerald-700">{{ session('success') }}</span>@endif
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500"><tr><th class="px-6 py-4">ID</th><th class="px-6 py-4">First Name</th><th class="px-6 py-4">Last Name</th><th class="px-6 py-4">Phone</th><th class="px-6 py-4">Email</th><th class="px-6 py-4 text-right">Actions</th></tr></thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($clients as $client)
                            <tr class="hover:bg-cyan-50/50">
                                <td class="px-6 py-4 font-medium text-slate-500">#{{ $client->id }}</td><td class="px-6 py-4 font-semibold">{{ $client->first_name }}</td><td class="px-6 py-4">{{ $client->last_name }}</td><td class="px-6 py-4">{{ $client->phone }}</td><td class="px-6 py-4">{{ $client->email }}</td>
                                <td class="px-6 py-4"><div class="flex justify-end gap-2"><button type="button" class="edit-client rounded-md bg-blue-50 px-3 py-1.5 font-semibold text-blue-700 hover:bg-blue-100" data-id="{{ $client->id }}" data-first-name="{{ $client->first_name }}" data-last-name="{{ $client->last_name }}" data-phone="{{ $client->phone }}" data-email="{{ $client->email }}">Edit</button><form action="{{ route('clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Remove this client?')">@csrf @method('DELETE')<button class="rounded-md bg-red-50 px-3 py-1.5 font-semibold text-red-700 hover:bg-red-100">Delete</button></form></div></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-6 py-16 text-center text-slate-500">No clients yet. Add your first client using the form.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script>
        const form = document.getElementById('client-form');
        const title = document.getElementById('form-title');
        const submitButton = document.getElementById('submit-button');
        const storeUrl = "{{ route('clients.store') }}";
        const updateTemplate = "{{ url('/clients/__CLIENT__') }}";

        document.querySelectorAll('.edit-client').forEach(button => button.addEventListener('click', () => {
            document.getElementById('first_name').value = button.dataset.firstName;
            document.getElementById('last_name').value = button.dataset.lastName;
            document.getElementById('phone').value = button.dataset.phone;
            document.getElementById('email').value = button.dataset.email;
            
            form.action = updateTemplate.replace('__CLIENT__', button.dataset.id);
            if (!document.getElementById('method-field')) form.insertAdjacentHTML('beforeend', '<input id="method-field" type="hidden" name="_method" value="PATCH">');
            title.textContent = 'Edit Client #' + button.dataset.id;
            submitButton.textContent = 'Save Changes';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }));

        document.getElementById('clear-button').addEventListener('click', () => {
            form.reset(); form.action = storeUrl;
            document.getElementById('method-field')?.remove();
            title.textContent = 'Add New Client'; submitButton.textContent = 'Add Client';
        });
    </script>
</x-app-layout>
