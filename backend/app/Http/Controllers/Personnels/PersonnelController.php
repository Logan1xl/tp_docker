<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    /**
     * Display a listing of personnel
     */
    public function index()
    {
        $personnel = Personnel::all();
        return view('personnel.index', compact('personnel'));
    }

    /**
     * Show the form for creating new personnel
     */
    public function create()
    {
        return view('personnel.create');
    }

    /**
     * Store a newly created personnel
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:personnel',
            'telephone' => 'required|string|max:20',
            'poste' => 'required|string|max:255',
        ]);

        Personnel::create($request->all());

        return redirect()->route('personnel.index')
            ->with('success', 'Personnel créé avec succès');
    }

    /**
     * Display the specified personnel
     */
    public function show(Personnel $personnel)
    {
        return view('personnel.show', compact('personnel'));
    }

    /**
     * Show the form for editing personnel
     */
    public function edit(Personnel $personnel)
    {
        return view('personnel.edit', compact('personnel'));
    }

    /**
     * Update the specified personnel
     */
    public function update(Request $request, Personnel $personnel)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:personnel,email,'.$personnel->id,
            'telephone' => 'required|string|max:20',
            'poste' => 'required|string|max:255',
        ]);

        $personnel->update($request->all());

        return redirect()->route('personnel.index')
            ->with('success', 'Personnel mis à jour avec succès');
    }

    /**
     * Remove the specified personnel
     */
    public function destroy(Personnel $personnel)
    {
        $personnel->delete();

        return redirect()->route('personnel.index')
            ->with('success', 'Personnel supprimé avec succès');
    }
}
