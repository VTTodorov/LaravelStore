<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    //
    public function new()
    {
        return view('location.add');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'Name' => "required|min:4|max:30"
        ]);

        $loc = new Location;

        $loc->name = $request->Name;

        $loc->save();

        return redirect('/home');
    }
}
