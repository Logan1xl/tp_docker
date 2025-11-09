<?php

namespace App\Http\Controllers;

use App\Models\Requete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequeteControllerApi extends Controller
{
    public function index()
    {
        return response()->json(Requete::all());
    }

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
            return response()->json($validator->errors(), 422);
        }

        return response()->json(Requete::create($request->all()), 201);
    }

    public function show(Requete $requete)
    {
        return response()->json($requete);
    }

    public function update(Request $request, Requete $requete)
    {
        $validator = Validator::make($request->all(), [
            'objet' => 'required|string|max:255',
            'description' => 'required|string',
            'preuve' => 'required|string',
            'matricule' => 'required|exists:etudiants,matricule'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $requete->update($request->all());
        return response()->json($requete);
    }

    public function destroy(Requete $requete)
    {
        $requete->delete();
        return response()->json(null, 204);
    }
}
