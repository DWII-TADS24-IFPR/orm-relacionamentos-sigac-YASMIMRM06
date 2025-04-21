<?php
// database/migrations/2023_01_01_000008_create_declaracoes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclaracoesTable extends Migration
{
    /**
     * Executa as migrações para criar a tabela de declarações.
     * 
     * Uma declaração é um documento oficial que comprova a participação
     * do aluno em determinada atividade, vinculada a um comprovante.
     */
    public function up()
    {
        Schema::create('declaracoes', function (Blueprint $table) {
            // Chave primária auto-incremento
            $table->id();
            
            // Hash único para identificação segura da declaração
            $table->string('hash', 64)->unique();
            
            // Data de emissão da declaração
            $table->dateTime('data');
            
            // Chave estrangeira para o aluno (quem recebe a declaração)
            $table->foreignId('aluno_id')
                  ->constrained('alunos')
                  ->onDelete('cascade'); // Se aluno for excluído, declarações também são
            
            // Chave estrangeira para o comprovante relacionado
            $table->foreignId('comprovante_id')
                  ->constrained('comprovantes')
                  ->onDelete('cascade'); // Se comprovante for excluído, declaração também é
            
            // Timestamps padrão do Laravel (created_at, updated_at)
            $table->timestamps();
            
            // Soft delete (deleted_at)
            $table->softDeletes();
            
            // Índices para melhorar performance em buscas frequentes
            $table->index('hash');
            $table->index('aluno_id');
            $table->index('comprovante_id');
        });
    }

    /**
     * Reverte as migrações - remove a tabela de declarações.
     */
    public function down()
    {
        // Remove as chaves estrangeiras primeiro para evitar erros
        Schema::table('declaracoes', function (Blueprint $table) {
            $table->dropForeign(['aluno_id']);
            $table->dropForeign(['comprovante_id']);
        });
        
        // Remove a tabela
        Schema::dropIfExists('declaracoes');
    }
}