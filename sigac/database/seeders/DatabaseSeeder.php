<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Ordem correta para evitar erros de relacionamento
        $this->call([
            NivelSeeder::class,
            EixoSeeder::class,
            CursoSeeder::class,
            TurmaSeeder::class,
            CategoriaSeeder::class,
            // UserSeeder::class, // Se existir
            AlunoSeeder::class,
            ComprovanteSeeder::class,
            // DocumentoSeeder::class, // Se necessário
            // DeclaracaoSeeder::class, // Se necessário
        ]);
    }
}