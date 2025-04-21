<?php
// database/migrations/2023_01_01_000002_create_cursos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150); // Nome completo do curso
            $table->string('sigla', 10); // Sigla (ex: ADS, ENF)
            $table->float('total_horas'); // Carga horária total
            $table->foreignId('nivel_id')->constrained('nivels'); // Chave estrangeira
            $table->foreignId('eixo_id')->constrained('eixos'); // Chave estrangeira
            $table->timestamps();
            $table->softDeletes();
            
            // Index para melhorar performance nas buscas
            $table->index('nome');
            $table->index('sigla');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cursos');
    }
}