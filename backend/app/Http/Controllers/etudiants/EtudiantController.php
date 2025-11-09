<?php

namespace App\Http\Controllers\etudiants;

use App\Models\Etudiant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $etudiants = Etudiant::all();
        return view("etudiants.formulaire", compact('etudiants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|string',
            'email' => 'required|email|max:255|unique:etudiants',
            'telephone' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:etudiants',
            'password' => 'required|string|max:255',
        ]);

        // Génération d'un matricule unique
        $matricule = 'IUC' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        // Création d'un nouvel étudiant
        Etudiant::create([
            'matricule' => $matricule,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'sexe' => $request->sexe,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'login' => $request->login,
            'password' => bcrypt($request->password), // Hashing the password for security
        ]);

        return redirect()->route('home')->with('success', 'Etudiant ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($matricule)
{
    try {
        $etudiant = Etudiant::where('matricule', $matricule)->firstOrFail();
        $etudiant->delete();
        return redirect()->route('inscription')->with('success', 'Etudiant supprimé avec succès');
    } catch (ModelNotFoundException $e) {
        return redirect()->route('inscription')->with('error', 'Etudiant non trouvé');
    }
}
}
