<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrivataisKatalogs;
use Illuminate\Support\Facades\Auth;


class PrivataisKatalogsController extends Controller
{
    public function index()
    {
        $ieraksti = PrivataisKatalogs::where('user_id', Auth::id())->get();
        return view('privatais.index', compact('ieraksti'));
    }


    public function create()
    {
        return view('privatais.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $validated['user_id'] = Auth::id();

        PrivataisKatalogs::create(array_merge($validated, $request->only([
            'body_type', 'fuel_type', 'transmission', 'engine_volume',
            'mileage', 'color', 'license_plate', 'vin', 'next_inspection',
            'description', 'prev_inspection_rating', 'prev_inspection_problem'
        ])));

        return redirect()->route('privatais.index')->with('success', 'Dati saglabāti!');
    }
}
