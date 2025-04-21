<?php
// database/migrations/2023_01_01_000003_create_turmas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmasTable extends Migration
{
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')->constrained('cursos');
            $table->integer('ano'); // Ano da turma (ex: 2023)
            $table->timestamps();
            $table->softDeletes();
            
            // Index composto para evitar turmas duplicadas no mesmo ano/curso
            $table->unique(['curso_id', 'ano']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('turmas');
    }
}