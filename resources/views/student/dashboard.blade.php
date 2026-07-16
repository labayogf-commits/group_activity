<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Student Information System
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-4">
                    Student Information Dashboard
                </h3>

                <p>Welcome to the Student Information System.</p>

                <a href="{{ route('students.index') }}"
                   class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                    Manage Students
                </a>

            </div>

        </div>
    </div>

</x-app-layout>