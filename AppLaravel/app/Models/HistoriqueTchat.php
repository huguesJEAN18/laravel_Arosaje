<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueTchat extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'historique_tchat'; 
    protected $fillable = [ 
        'id_user',
        'id_destinataire',
        'message',
        'image',
    ];
}
