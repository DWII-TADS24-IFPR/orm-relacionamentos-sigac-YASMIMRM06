<?php
// database/seeders/EixoSeeder.php

namespace Database\Seeders;

use App\Models\Eixo;
use Illuminate\Database\Seeder;

class EixoSeeder extends Seeder
{
    public function run()
    {
        $eixos = [
            ['nome' => 'Tecnologia'],
            ['nome' => 'Saúde'],
            ['nome' => 'Gestão'],
            ['nome' => 'Humanas'],
        ];

        foreach ($eixos as $eixo) {
            Eixo::create($eixo);
            $this->command->info("Eixo {$eixo['nome']} criado!");
        }
    }
}