<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Artigo;
use Illuminate\Support\Str;

class ArtigoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->words(5,true),
            'descricao' => $this->faker->words(5,true),
            'conteudo' => $this->faker->paragraphs(2,true),
            'slug' => $this->faker->slug(),
            'user_id' => rand(1,11),
            'created_at' => now()
        ];
    }
}
