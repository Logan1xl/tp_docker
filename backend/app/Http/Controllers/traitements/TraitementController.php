<?php

namespace App\Http\Controllers;

use App\Models\Traitement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TraitementController extends Controller
{
    public function index()
    {
        $traitements = Traitement::all();
        return view('traitements.index', compact('traitements'));
    }

    public function create()
    {
        return view('traitements.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:traitements',
            'date_req' => 'required|date',
            'contenu' => 'required|string',
            'statut' => 'required|integer',
            'service' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Traitement::create($request->all());

        return redirect()->route('traitements.index')
            ->with('success', 'Traitement créé avec succès');
    }

    public function show(Traitement $traitement)
    {
        return view('traitements.show', compact('traitement'));
    }

    public function edit(Traitement $traitement)
    {
        return view('traitements.edit', compact('traitement'));
    }

    public function update(Request $request, Traitement $traitement)
    {
        $validator = Validator::make($request->all(), [
            'date_req' => 'required|date',
            'contenu' => 'required|string',
            'statut' => 'required|integer',
            'service' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $traitement->update($request->all());

        return redirect()->route('traitements.index')
            ->with('success', 'Traitement mis à jour avec succès');
    }

    public function destroy(Traitement $traitement)
    {
        $traitement->delete();
        return redirect()->route('traitements.index')
            ->with('success', 'Traitement supprimé avec succès');
    }
}
