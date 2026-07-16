<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2 text-gray-800">Welcome to your Group Act Dashboard!</h3>
                    <p class="text-gray-600">
                        {{ __("You're logged in!") }} You can now use the new dynamic sidebar on the left to navigate to your team's modules.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>