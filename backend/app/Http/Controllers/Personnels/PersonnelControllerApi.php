<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;

class PersonnelControllerApi extends Controller
{
    public function index()
    {
        return response()->json(Personnel::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:personnel',
            'telephone' => 'required|string|max:20',
            'poste' => 'required|string|max:255',
        ]);

        $personnel = Personnel::create($request->all());
        return response()->json($personnel, 201);
    }

    public function show(Personnel $personnel)
    {
        return response()->json($personnel, 200);
    }

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
        return response()->json($personnel, 200);
    }

    public function destroy(Personnel $personnel)
    {
        $personnel->delete();
        return response()->json(null, 204);
    }
}
