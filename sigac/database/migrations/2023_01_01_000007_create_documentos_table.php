<?php
// database/migrations/2023_01_01_000007_create_documentos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('url'); // Caminho/URL do documento
            $table->text('descricao'); // Descrição mais longa
            $table->float('horas_in'); // Horas solicitadas
            $table->string('status', 20); // Status (pendente, aprovado, recusado)
            $table->text('comentario')->nullable(); // Comentário opcional
            $table->float('horas_out')->nullable(); // Horas aprovadas (pode ser diferente)
            $table->foreignId('categoria_id')->constrained('categories');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}