<?php

namespace App\Modules\JohnmarCRUD\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * CrudController handles the CRUD operations for the JohnmarCRUD module.
 * It uses Laravel's Session to temporarily store the items instead of a database.
 */
class CrudController extends Controller
{
    /**
     * Display a listing of the items.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve the current list of items from the session, defaulting to an empty array if none exist
        $items = Session::get('johnmar_items', []);

        // Return the main index view for the JohnmarCRUD module, passing the items array to the view
        return view('JohnmarCRUD::index', compact('items'));
    }

    /**
     * Store a newly created item in the session storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request data to ensure required fields are provided
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|max:50',
        ]);

        // Get the existing items from the session
        $items = Session::get('johnmar_items', []);
        
        // Append the new item to the array, automatically generating a simple sequential ID
        $items[] = [
            'id' => count($items) + 1,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? '',
            'status' => $validated['status'],
        ];

        // Save the updated items array back into the session
        Session::put('johnmar_items', $items);

        // Redirect back to the index page with a success flash message
        return redirect()->route('johnmarcrud.index')->with('success', 'Item added successfully.');
    }

    /**
     * Show the form for editing the specified item.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Retrieve all items from the session
        $items = Session::get('johnmar_items', []);
        
        // Use Laravel Collections to find the first item that matches the given ID
        $item = collect($items)->firstWhere('id', (int) $id);

        // If the item doesn't exist, throw a 404 Not Found exception
        if (! $item) {
            abort(404);
        }

        // Return the main view again, but this time passing the specific $item to trigger the edit modal
        return view('JohnmarCRUD::index', compact('items', 'item'));
    }

    /**
     * Update the specified item in the session storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming data from the update form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|max:50',
        ]);

        // Retrieve existing items
        $items = Session::get('johnmar_items', []);
        $updatedItems = [];

        // Loop through each item to find the one we need to update
        foreach ($items as $item) {
            // Check if the current item matches the requested ID
            if ((int) $item['id'] === (int) $id) {
                // Update the item's properties with the new validated data
                $item['name'] = $validated['name'];
                $item['description'] = $validated['description'] ?? '';
                $item['status'] = $validated['status'];
            }

            // Push the (potentially updated) item to our new array
            $updatedItems[] = $item;
        }

        // Save the modified array back to the session, overwriting the old data
        Session::put('johnmar_items', $updatedItems);

        // Redirect back to the index page with a success message
        return redirect()->route('johnmarcrud.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified item from session storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Retrieve the current list of items
        $items = Session::get('johnmar_items', []);
        
        // Use array_filter to keep only the items whose ID does NOT match the given ID
        // array_values is used to re-index the array sequentially so there are no missing keys
        $filtered = array_values(array_filter($items, fn($item) => (int) $item['id'] !== (int) $id));

        // Save the filtered array back to the session
        Session::put('johnmar_items', $filtered);

        // Redirect back with a success message
        return redirect()->route('johnmarcrud.index')->with('success', 'Item deleted successfully.');
    }
}
