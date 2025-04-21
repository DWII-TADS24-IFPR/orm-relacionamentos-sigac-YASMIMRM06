<?php
// database/seeders/AlunoSeeder.php

namespace Database\Seeders;

use App\Models\Aluno;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AlunoSeeder extends Seeder
{
    public function run()
    {
        // Obtém turmas e cursos
        $turmaADS2023 = \App\Models\Turma::where('ano', 2023)
            ->whereHas('curso', function($q) {
                $q->where('sigla', 'ADS');
            })->first();

        $turmaINFO2023 = \App\Models\Turma::where('ano', 2023)
            ->whereHas('curso', function($q) {
                $q->where('sigla', 'INFO');
            })->first();

        // Cria usuários professores primeiro
        $professorADS = \App\Models\User::create([
            'nome' => 'Professor ADS',
            'email' => 'prof.ads@example.com',
            'senha' => Hash::make('password'),
            'role_id' => 2, // Assumindo que 2 é o ID para professores
        ]);

        $alunos = [
            [
                'nome' => 'João Silva',
                'cpf' => '12345678901',
                'email' => 'joao@aluno.example.com',
                'senha' => Hash::make('aluno123'),
                'user_id' => $professorADS->id,
                'curso_id' => $turmaADS2023->curso_id,
                'turma_id' => $turmaADS2023->id,
            ],
            [
                'nome' => 'Maria Souza',
                'cpf' => '98765432109',
                'email' => 'maria@aluno.example.com',
                'senha' => Hash::make('aluno123'),
                'user_id' => $professorADS->id,
                'curso_id' => $turmaINFO2023->curso_id,
                'turma_id' => $turmaINFO2023->id,
            ],
            // Adicione mais alunos conforme necessário
        ];

        foreach ($alunos as $aluno) {
            Aluno::create($aluno);
            $this->command->info("Aluno {$aluno['nome']} criado!");
        }
    }
}