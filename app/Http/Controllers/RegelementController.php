<?php

namespace App\Http\Controllers;

use App\Models\Regelement;
use Illuminate\Http\Request;

class RegelementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regelement = Regelement::all();
        return view('regelements.index', compact('regelement'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('regelements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Regelement::create($request->all());

        return redirect()->route('regelements.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Regelement $regelement)
    {
        return view('regelements.show', compact('regelement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Regelement $regelement)
    {
        return view('regelements.edit', compact('regelement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Regelement $regelement)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $regelement->update($request->all());

        return redirect()->route('regelements.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Regelement $regelement)
    {
        $regelement->delete();

        return redirect()->route('regelements.index');
    }
}
