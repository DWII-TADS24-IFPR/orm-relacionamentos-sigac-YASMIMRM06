<?php
// database/migrations/2023_01_01_000008_create_declaracoes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclaracoesTable extends Migration
{
    public function up()
    {
        Schema::create('declaracoes', function (Blueprint $table) {
            $table->id();
            $table->string('hash')->unique(); // Identificador único
            $table->dateTime('data'); // Data de emissão
            $table->foreignId('aluno_id')->constrained('alunos');
            $table->foreignId('comprovante_id')->constrained('comprovantes');
            $table->timestamps();
            $table->softDeletes();
            
            // Index para busca rápida por hash
            $table->index('hash');
        });
    }

    public function down()
    {
        Schema::dropIfExists('declaracoes');
    }
}