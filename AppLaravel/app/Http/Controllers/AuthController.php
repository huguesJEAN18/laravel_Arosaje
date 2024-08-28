<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('mot_de_passe');

        // Rechercher l'utilisateur par email
        $user = User::where('email', $email)->first();

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && $user->validatePassword($password)) {
            // Générer un jeton JWT pour l'utilisateur
            $token = JWTAuth::fromUser($user);

            // Retourner le jeton JWT
            return response()->json(compact('token'));
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public function refresh()
    {
        $token = JWTAuth::parseToken()->refresh();
        return response()->json(compact('token'));
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me()
    {
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json(compact('user'));
    }
}
