<?php

namespace App\Modules\HotelManagement\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Import your Client model if you are using it
use App\Modules\HotelManagement\Models\Client; 

class ClientController extends Controller
{
    public function index()
    {
        return view('HotelManagement::index', [
            'clients' => Client::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        Client::create($this->validatedClient($request));

        return redirect()->route('hotel.index')->with('success', 'Client added successfully.');
    }

    public function update(Request $request, Client $client)
    {
        $client->update($this->validatedClient($request, $client));

        return redirect()->route('hotel.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('hotel.index')->with('success', 'Client removed successfully.');
    }

    private function validatedClient(Request $request, ?Client $client = null): array
    {
        return $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255', 'unique:clients,email'.($client ? ','.$client->id : '')],
        ]);
    }
}
