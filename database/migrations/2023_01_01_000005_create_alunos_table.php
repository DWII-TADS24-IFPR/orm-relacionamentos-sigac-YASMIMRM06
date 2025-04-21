<?php
// database/migrations/2023_01_01_000005_create_alunos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration
{
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->string('cpf', 11)->unique(); // CPF sem formatação
            $table->string('email', 100)->unique();
            $table->string('senha');
            $table->foreignId('user_id')->constrained('users'); // Relação com usuário
            $table->foreignId('curso_id')->constrained('cursos');
            $table->foreignId('turma_id')->constrained('turmas');
            $table->timestamps();
            $table->softDeletes();
            
            // Index para campos de busca frequente
            $table->index('nome');
            $table->index('cpf');
        });
    }

    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}