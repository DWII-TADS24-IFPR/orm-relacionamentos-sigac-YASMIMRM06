<?php
// database/seeders/TurmaSeeder.php

namespace Database\Seeders;

use App\Models\Turma;
use Illuminate\Database\Seeder;

class TurmaSeeder extends Seeder
{
    public function run()
    {
        // Obtém os cursos
        $cursoADS = \App\Models\Curso::where('sigla', 'ADS')->first();
        $cursoINFO = \App\Models\Curso::where('sigla', 'INFO')->first();

        $turmas = [
            [
                'curso_id' => $cursoADS->id,
                'ano' => 2023,
            ],
            [
                'curso_id' => $cursoADS->id,
                'ano' => 2024,
            ],
            [
                'curso_id' => $cursoINFO->id,
                'ano' => 2023,
            ],
        ];

        foreach ($turmas as $turma) {
            Turma::create($turma);
            $this->command->info("Turma {$turma['ano']} do curso {$curso->sigla} criada!");
        }
    }
}