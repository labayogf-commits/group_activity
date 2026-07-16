<!-- x-app-layout is the main layout component that wraps the page. It includes the navigation bar, sidebar, and provides the basic page structure. -->
<x-app-layout>
    <!-- The header slot is inserted into the layout's header section (usually a white bar below navigation). -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Johnmar CRUD') }}
        </h2>
    </x-slot>

    <!-- Main page container with vertical padding (py-12). -->
    <div class="py-12">
        <!-- max-w-7xl centers the content and restricts max width. 
             x-data initializes Alpine.js state. 'showForm' toggles the modal's visibility. 
             If $item exists (we are editing), showForm defaults to true so the modal opens automatically. -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ showForm: {{ isset($item) ? 'true' : 'false' }} }">
            
            <!-- White card container with shadow and rounded corners -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Section: Header & Add Button -->
                    <!-- flex and justify-between place the title on the left and the button on the right -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Johnmar CRUD</h1>
                        
                        <!-- When clicked, this button toggles the 'showForm' state, opening or closing the modal -->
                        <button @click="showForm = !showForm" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                            <!-- x-text dynamically changes the button text based on whether the modal is open or closed -->
                            <span x-text="showForm ? 'Close Form' : 'Add New Item'"></span>
                        </button>
                    </div>

                    <!-- Section: Alert/Notification -->
                    <!-- Checks if a 'success' session message exists (e.g., after saving or deleting an item) -->
                    @if (session('success'))
                    <div class="mb-6 rounded-md bg-green-50 p-4 border border-green-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <!-- Green check icon -->
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <!-- Displays the actual success message passed from the controller -->
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Section: Add/Edit Form (Modal) -->
                    <!-- x-show links the visibility of this element to the showForm state. z-50 ensures it stays on top of other content. fixed inset-0 makes it cover the entire screen. -->
                    <div x-show="showForm" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            
                            <!-- Modal Background Overlay -->
                            <!-- Clicking this dark semi-transparent background closes the modal (@click="showForm = false") -->
                            <div x-show="showForm" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="showForm = false"></div>

                            <!-- Trick to vertically center the modal in Tailwind -->
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                            <!-- Modal Panel -->
                            <!-- This is the actual white box containing the form. It has transition classes for smooth entering and exiting animations. -->
                            <div x-show="showForm" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                            
                                            <!-- Modal Title changes based on whether we are creating or updating an item -->
                                            <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                                {{ isset($item) ? 'Update Item' : 'Add New Item' }}
                                            </h3>
                                            
                                            <div class="mt-4">
                                                <!-- The form points to the update route if $item exists, otherwise it goes to store. id="crud-form" connects to the submit button outside the form. -->
                                                <form action="{{ isset($item) ? route('johnmarcrud.update', $item['id']) : route('johnmarcrud.store') }}" method="POST" id="crud-form">
                                                    @csrf <!-- CSRF token for security -->
                                                    
                                                    <!-- Use PUT method for updating an existing resource -->
                                                    @if (isset($item))
                                                    @method('PUT')
                                                    @endif
                                                    
                                                    <!-- grid-cols-1 stacks inputs vertically. gap-4 provides spacing between them. -->
                                                    <div class="grid grid-cols-1 gap-4">
                                                        
                                                        <!-- Name Input Field -->
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                                            <input type="text" name="name" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ isset($item) ? $item['name'] : '' }}" required>
                                                        </div>
                                                        
                                                        <!-- Description Input Field -->
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                                            <input type="text" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ isset($item) ? $item['description'] : '' }}">
                                                        </div>
                                                        
                                                        <!-- Status Input Field -->
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                                            <input type="text" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ isset($item) ? $item['status'] : '' }}" required>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Modal Action Buttons Area -->
                                <!-- bg-gray-50 gives a slight off-white color to separate buttons from the form content -->
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    
                                    <!-- Submit Button (Triggers the form via form="crud-form" attribute) -->
                                    <button type="submit" form="crud-form" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                        {{ isset($item) ? 'Update Item' : 'Save Item' }}
                                    </button>
                                    
                                    <!-- Cancel Buttons based on context -->
                                    @if (isset($item))
                                    <!-- If editing, cancelling navigates back to the index page to clear the $item state -->
                                    <a href="{{ route('johnmarcrud.index') }}" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Cancel
                                    </a>
                                    @else
                                    <!-- If adding new, cancelling just closes the modal via Alpine.js -->
                                    <button type="button" @click="showForm = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Cancel
                                    </button>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <!-- Section: Data Table -->
                    <!-- overflow-x-auto ensures the table is scrollable horizontally on small screens -->
                    <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200">
                            
                            <!-- Table Header -->
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            
                            <!-- Table Body -->
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Loop through items and output a row for each. If there are no items, the empty block executes. -->
                                @forelse ($items as $itemRow)
                                <tr class="hover:bg-gray-50 transition-colors"> <!-- hover effect for better UX -->
                                    
                                    <!-- Display ID -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $itemRow['id'] }}</td>
                                    
                                    <!-- Display Name -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $itemRow['name'] }}</td>
                                    
                                    <!-- Display Description -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $itemRow['description'] }}</td>
                                    
                                    <!-- Display Status as a Badge -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $itemRow['status'] }}
                                        </span>
                                    </td>
                                    
                                    <!-- Action Buttons (Edit & Delete) -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        
                                        <!-- Edit Link -> Redirects to the edit route to populate the modal -->
                                        <a href="{{ route('johnmarcrud.edit', $itemRow['id']) }}" class="inline-flex text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-md transition-colors mr-2">Edit</a>
                                        
                                        <!-- Delete Form -> Forms are required for DELETE HTTP requests in Laravel -->
                                        <form action="{{ route('johnmarcrud.destroy', $itemRow['id']) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE') <!-- Spoofing the DELETE method -->
                                            <!-- The onclick attribute provides a basic browser confirmation dialog before submitting the delete request -->
                                            <button type="submit" class="inline-flex text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-md transition-colors" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                
                                <!-- Fallback layout for when no records exist in the database -->
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <!-- Empty state icon -->
                                            <svg class="h-10 w-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <p>No records found.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>