<?php

namespace App\Http\Controllers;

use App\Models\Requete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequeteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requetes = Requete::all();
        return view('requetes.index', compact('requetes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('requetes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:requetes',
            'objet' => 'required|string|max:255',
            'description' => 'required|string',
            'preuve' => 'required|string',
            'matricule' => 'required|exists:etudiants,matricule'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Requete::create($request->all());

        return redirect()->route('requetes.index')
            ->with('success', 'Requête créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Requete $requete)
    {
        return view('requetes.show', compact('requete'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requete $requete)
    {
        return view('requetes.edit', compact('requete'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requete $requete)
    {
        $validator = Validator::make($request->all(), [
            'objet' => 'required|string|max:255',
            'description' => 'required|string',
            'preuve' => 'required|string',
            'matricule' => 'required|exists:etudiants,matricule'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $requete->update($request->all());

        return redirect()->route('requetes.index')
            ->with('success', 'Requête mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requete $requete)
    {
        $requete->delete();
        return redirect()->route('requetes.index')
            ->with('success', 'Requête supprimée avec succès');
    }
}
