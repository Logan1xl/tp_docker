<?php

namespace App\Http\Controllers;

use App\Models\Traitement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TraitementControllerApi extends Controller
{
    public function index()
    {
        return response()->json(Traitement::all());
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
            return response()->json($validator->errors(), 422);
        }

        return response()->json(Traitement::create($request->all()), 201);
    }

    public function show(Traitement $traitement)
    {
        return response()->json($traitement);
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
            return response()->json($validator->errors(), 422);
        }

        $traitement->update($request->all());
        return response()->json($traitement);
    }

    public function destroy(Traitement $traitement)
    {
        $traitement->delete();
        return response()->json(null, 204);
    }
}
