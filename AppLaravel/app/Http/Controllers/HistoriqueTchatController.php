<?php

namespace App\Http\Controllers;

use App\Models\HistoriqueTchat;
use Illuminate\Http\Request;

class HistoriqueTchatController extends Controller
{
    public function index()
    {
        $historiqueChat = HistoriqueTchat::all();
        return response()->json($historiqueChat);
    }

    public function getAllHistoriqueMessage(Request $request)
    {
        // Valider que les paramètres id_user et id_destinataire sont présents
        $validatedData = $request->validate([
            'id_user' => 'required|integer',
            'id_destinataire' => 'required|integer',
        ]);
    
        // Rechercher les messages avec les critères id_user et id_destinataire
        $historiqueChat = HistoriqueTchat::where('id_user', $validatedData['id_user'])
                            ->where('id_destinataire', $validatedData['id_destinataire'])
                            ->get();
    
        // Retourner la réponse en format JSON
        return response()->json($historiqueChat);
    }
    

    public function store(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'id_user' => 'required|integer',
            'id_destinataire' => 'required|integer',
            'message' => 'required|string',
            'image' => 'nullable|string', 
        ]);

        // Créer un nouveau message
        $message = new HistoriqueTchat();
        $message->id_user = $request->id_user;
        $message->id_destinataire = $request->id_destinataire;
        $message->message = $request->message;
        $message->image = $request->image;
        $message->save();

        // Répondre avec le message créé
        return response()->json($message, 201);
    }
    
}