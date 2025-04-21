<?php
// database/seeders/NivelSeeder.php

namespace Database\Seeders;

use App\Models\Nivel;
use Illuminate\Database\Seeder;

class NivelSeeder extends Seeder
{
    /**
     * Cria os níveis básicos do sistema
     */
    public function run()
    {
        // Array com os níveis padrão
        $niveis = [
            ['nome' => 'Técnico'],
            ['nome' => 'Graduação'],
            ['nome' => 'Pós-Graduação'],
            ['nome' => 'Extensão'],
        ];

        // Percorre o array criando cada nível
        foreach ($niveis as $nivel) {
            Nivel::create($nivel);
            
            // Exibe mensagem no console (opcional)
            $this->command->info("Nível {$nivel['nome']} criado com sucesso!");
        }
    }
}