<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artigo extends Model
{
    use HasFactory;
    protected $table = 'artigos';
    protected $fillable = 
    [
        'titulo',
        'descricao',
        'conteudo',
        'slug',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }    

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }
    
}


