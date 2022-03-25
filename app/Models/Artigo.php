<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artigo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'artigos';
    protected $fillable = 
    [
        'titulo',
        'descricao',
        'conteudo',
        'slug',
        'user_id',
        'imagem',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }    

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }

    public function temas(){
        return $this->belongsToMany(Tema::class,'temas_artigos','artigos_id','temas_id');
    }
    
}


