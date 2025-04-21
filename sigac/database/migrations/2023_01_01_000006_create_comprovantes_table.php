<?php
// database/migrations/2023_01_01_000006_create_comprovantes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprovantesTable extends Migration
{
    public function up()
    {
        Schema::create('comprovantes', function (Blueprint $table) {
            $table->id();
            $table->float('horas'); // Horas comprovadas
            $table->string('atividade', 255); // Descrição da atividade
            $table->foreignId('categoria_id')->constrained('categories');
            $table->foreignId('aluno_id')->constrained('alunos');
            $table->foreignId('user_id')->constrained('users'); // Quem registrou
            $table->timestamps();
            $table->softDeletes();
            
            // Index para consultas frequentes
            $table->index('aluno_id');
            $table->index('categoria_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comprovantes');
    }
}