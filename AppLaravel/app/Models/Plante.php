<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plante extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'plantes'; 
    protected $fillable = [ 
        'name_plante',
        'image',
        'localisation',
        'id_user',
       
    ];
}

