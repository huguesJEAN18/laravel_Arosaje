<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Récupérer tous les utilisateurs
        $users = User::all();
        // Retourner les utilisateurs sous forme de réponse JSON
        return response()->json($users);
    }
    public function insert(Request $request)
    {
        // Récupération des données de la requête
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $email = $request->input('email');
        $mot_de_passe = $request->input('mot_de_passe');
        $user_type = $request->input('user_type');
        $telephone = $request->input('telephone');
        $avatar = $request->input('avatar');

        // Construction des données à insérer
        $data = array(
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mot_de_passe' => Hash::make($mot_de_passe),
            'user_type' => $user_type,
            'telephone' => $telephone,
            'avatar' => $avatar
        );
        // Insertion des données dans la base de données
        DB::table('user')->insert($data);
        // Retourner une réponse
        return response()->json(['message' => 'Utilisateur inséré avec succès'], 201);
    }

    public function getUser($id)
    {
        $user = User::where('id_user', $id)->first();    
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }  
        return response()->json($user);
    }
    public function validatePassword($password)
    {
        return Hash::check($password, $this->mot_de_passe);
    }
    
}
