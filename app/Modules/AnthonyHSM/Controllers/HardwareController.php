<?php

namespace App\Modules\AnthonyHSM\Controllers; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HardwareController extends Controller
{ // <--- DAPAT NANDITO ITONG CURLY BRACE NA ITO, BOI!

    /**
     * Ipakita ang Core Hardware Dashboard
     */
    public function index()
    {
        // PANSAMANTALANG I-COMMENT OUT ITONG DALAWANG LINYA SA IBABA:
        // if (!session()->has('is_admin_logged_in')) {
        //     return redirect('/login');
        // }

        $assets = \DB::table('hardware')->get();
        return view('AnthonyHSM::index', compact('assets')); 
    }

   
    /**
     * I-proseso ang Pag-save ng Bagong Hardware Asset
     */
    public function store(Request $request)
    {
        \DB::table('hardware')->insert([
            'asset_tag'  => $request->asset_tag,
            'name'       => $request->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/hardware-portal');
    }
    /**
     * I-proseso ang Pagtanggal (Terminate) ng Hardware Asset
     */
    public function destroy($id)
    {
        \DB::table('hardware')->where('id', $id)->delete();
        return redirect('/hardware-portal');
    }
} // <--- AT DAPAT MAY CLOSING CURLY BRACE DIN SA PINAKA-ILALIM!