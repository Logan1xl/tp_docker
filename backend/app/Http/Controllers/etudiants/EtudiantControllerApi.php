<?php

namespace App\Http\Controllers\etudiants;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EtudiantControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiant::all()->makeHidden(['password']);
        return response()->json($etudiants, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nom'       => 'required',
                'telephone'      => 'required',
                "prenom"    => "required",
                'sexe'     => 'required',
                'email'   => 'required',
                'login' => 'required',
                'password'    => 'required'
            ]
        );

        try {
            DB::beginTransaction();
            $etudiant = Etudiant::create(array_merge(
                $request->all(),
                ["matricule" => $this->generate_mat(), "password" => bcrypt($request->password)]
            ));
            DB::commit();
            return response()->json($etudiant->makeHidden(['password']), 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json('{"error": "Impossible de sauvegarder"}', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        $etudiant_found =  Etudiant::find($etudiant->matricule);
        if ($etudiant_found) {
            return response()->json($etudiant_found->makeHidden(['password']), 200);
        } else {
            return response()->json('{"error": "Etudiant non trouvé"}', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $request->validate([
            "nom" => "sometimes|required|max:100",
            "prenom" => "sometimes|required|max:100",
            "sexe" => "sometimes|required",
            "telephone" => "sometimes|required|max:12",
            "email" => "sometimes|required|email",
            "login" => "sometimes|required",
            "password" => "sometimes|required",
        ]);

        try {
            DB::beginTransaction();

            $data = $request->all();

            if ($request->has('password')) {
                $data['password'] = bcrypt($request->password);
            }

            $etudiant->update($data);

            DB::commit();

            return response()->json(["success" => "Etudiant mis à jour avec succès", "etudiant" => $etudiant], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json(["error" => "Une erreur est survenue lors de la mise à jour de l'étudiant : " . $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return response()->json($etudiant, 200);
    }

    function generate_mat()
    {
        $mat = "IUC" . sprintf("%03d", rand(1, 999));
        if (Etudiant::find($mat) != null) {
            return $this->generate_mat();
        }
        return $mat;
    }
}
