<?php

namespace Database\Seeders;

use App\Models\Artigo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtigosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('artigos')->insert([
            'titulo' => 'Sobre as seeds',
            'descricao' => 'Uso de seeds para criar dados',
            'conteudo' => 'A criação de dados através das seeds...',
            'slug' => 'sobre-as-seeds',
            'user_id' => 1,
            'created_at' => now(), 
       ]);*/            
       $artigo = Artigo::factory()->count(30)->create();
       
    }
}
