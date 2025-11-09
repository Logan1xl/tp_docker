<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Etudiant;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);
        $type = "";
        $code = "";
        $user = Etudiant::where('login', $request->login)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            $user = Personnel::where("login_pers", $request->login)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['error' => 'Invalid Credentials'], 401);
            } else
                $type = "personnel";
            $code = $user->code_pers;
        } else {
            $type = "etudiant";
            $code = $user->matricule;
        }
        $old_token = DB::table('personal_access_tokens')->where("tokenable_id", $code)->get();
        if ($old_token)
            DB::table('personal_access_tokens')->delete($old_token->get("id"));
        $expiration = Carbon::now()->addDays(1);


        $token = $user->createToken("user_token", ["*"], $expiration)->plainTextToken;
        return response()->json(['token' => $token, 'user' => $user, 'type' => $type]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Deconnecte avec sucess'], 200);
    }
}
