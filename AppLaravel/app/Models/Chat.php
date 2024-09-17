<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'chat'; 
    protected $fillable = [ 
        'id_user',
        'id_recipient',
        'title',
        'name_recipient',
    ];
}
