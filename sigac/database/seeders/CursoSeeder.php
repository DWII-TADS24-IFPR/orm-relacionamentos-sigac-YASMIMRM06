<?php
// database/seeders/CursoSeeder.php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    public function run()
    {
        // Obtém os IDs dos níveis e eixos (assumindo que já foram criados)
        $nivelTecnico = \App\Models\Nivel::where('nome', 'Técnico')->first()->id;
        $nivelGraduacao = \App\Models\Nivel::where('nome', 'Graduação')->first()->id;
        
        $eixoTecnologia = \App\Models\Eixo::where('nome', 'Tecnologia')->first()->id;
        $eixoGestao = \App\Models\Eixo::where('nome', 'Gestão')->first()->id;

        $cursos = [
            [
                'nome' => 'Análise e Desenvolvimento de Sistemas',
                'sigla' => 'ADS',
                'total_horas' => 2000,
                'nivel_id' => $nivelGraduacao,
                'eixo_id' => $eixoTecnologia,
            ],
            [
                'nome' => 'Técnico em Informática',
                'sigla' => 'INFO',
                'total_horas' => 1200,
                'nivel_id' => $nivelTecnico,
                'eixo_id' => $eixoTecnologia,
            ],
            // Adicione mais cursos conforme necessário
        ];

        foreach ($cursos as $curso) {
            Curso::create($curso);
            $this->command->info("Curso {$curso['nome']} criado!");
        }
    }
}