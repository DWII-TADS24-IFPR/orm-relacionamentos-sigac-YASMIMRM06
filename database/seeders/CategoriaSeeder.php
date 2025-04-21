<?php
// database/seeders/CategoriaSeeder.php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $cursoADS = \App\Models\Curso::where('sigla', 'ADS')->first();
        $cursoINFO = \App\Models\Curso::where('sigla', 'INFO')->first();

        $categorias = [
            // Categorias para ADS
            [
                'nome' => 'Extensão',
                'maximo_horas' => 200,
                'curso_id' => $cursoADS->id,
            ],
            [
                'nome' => 'Pesquisa',
                'maximo_horas' => 150,
                'curso_id' => $cursoADS->id,
            ],
            
            // Categorias para INFO
            [
                'nome' => 'Atividades Complementares',
                'maximo_horas' => 100,
                'curso_id' => $cursoINFO->id,
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
            $this->command->info("Categoria {$categoria['nome']} criada para o curso {$categoria['curso_id']}!");
        }
    }
}