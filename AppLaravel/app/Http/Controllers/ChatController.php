<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 
use App\Models\Chat;

class ChatController extends Controller
{
    public function getChatsByUser($id_user)
    {
        // Récupérer les chats où l'id_user correspond à l'utilisateur donné
        $chats = Chat::where('id_user', $id_user)->get();
        
        // Retourner les chats sous forme de réponse JSON
        return response()->json($chats);
    }

    public function insert(Request $request)
    {
        // Validation des données
        $request->validate([
            'id_user' => 'required|integer',
            'id_recipient' => 'required|integer',
            'title' => 'required|string|max:255',
            'name_recipient' => 'required|string|max:255',
        ]);

        try {
            // Création d'une nouvelle instance de Chat
            $chat = new Chat([
                'id_user' => $request->input('id_user'),
                'id_recipient' => $request->input('id_recipient'),
                'title' => $request->input('title'),
                'name_recipient' => $request->input('name_recipient'),
            ]);

            // Sauvegarde dans la base de données
            $chat->save();

            // Retourner une réponse
            return response()->json(['message' => 'Chat inséré avec succès'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de l\'insertion',
                'details' => $e->getMessage()
            ], 500);}
    }
}