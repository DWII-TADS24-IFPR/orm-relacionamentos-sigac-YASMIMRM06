<?php
// database/seeders/ComprovanteSeeder.php

namespace Database\Seeders;

use App\Models\Comprovante;
use Illuminate\Database\Seeder;

class ComprovanteSeeder extends Seeder
{
    public function run()
    {
        $alunoJoao = \App\Models\Aluno::where('email', 'joao@aluno.example.com')->first();
        $categoriaExtensao = \App\Models\Categoria::where('nome', 'Extensão')->first();
        $professorADS = \App\Models\User::where('email', 'prof.ads@example.com')->first();

        $comprovantes = [
            [
                'horas' => 20,
                'atividade' => 'Participação em workshop de Laravel',
                'categoria_id' => $categoriaExtensao->id,
                'aluno_id' => $alunoJoao->id,
                'user_id' => $professorADS->id,
            ],
            [
                'horas' => 10,
                'atividade' => 'Minicurso de Git e GitHub',
                'categoria_id' => $categoriaExtensao->id,
                'aluno_id' => $alunoJoao->id,
                'user_id' => $professorADS->id,
            ],
        ];

        foreach ($comprovantes as $comprovante) {
            Comprovante::create($comprovante);
            $this->command->info("Comprovante '{$comprovante['atividade']}' criado!");
        }
    }
}