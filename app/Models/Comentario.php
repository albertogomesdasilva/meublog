<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'comentarios';
    protected $fillable = [
        'artigos_id',
        'user_id',
        'texto',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function artigo(){
        return $this->belongsTo(Artigo::class,'artigos_id');
    }
    
}
