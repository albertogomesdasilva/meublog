<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;    
    public $timestamps = false;     //desativamos o timestamps no model
    protected $table = 'temas';
    protected $fillable = [
        'titulo',
        'descricao',
        'slug',
    ];

    public function artigos(){
    return $this->belongsToMany(Artigo::class, 'temas_artigos', 'temas_id','artigos_id');
    }

}
