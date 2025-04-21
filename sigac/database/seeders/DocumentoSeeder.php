<?php
// database/migrations/2023_01_01_000007_create_documentos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Executa as migrações para criar a tabela de documentos.
     * 
     * Documentos são arquivos enviados para comprovar atividades,
     * podendo ser analisados e aprovados/reprovados pelo sistema.
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            // Chave primária auto-incremento
            $table->id();
            
            // URL ou caminho do arquivo no sistema de armazenamento
            $table->string('url');
            
            // Descrição detalhada do documento
            $table->text('descricao');
            
            // Horas solicitadas pelo aluno (pode conter decimais)
            $table->float('horas_in');
            
            // Status do documento (enum: pendente, aprovado, reprovado)
            $table->enum('status', ['pendente', 'aprovado', 'reprovado'])->default('pendente');
            
            // Comentário opcional do avaliador
            $table->text('comentario')->nullable();
            
            // Horas aprovadas (pode ser diferente do solicitado)
            $table->float('horas_out')->nullable();
            
            // Chave estrangeira para a categoria do documento
            $table->foreignId('categoria_id')
                  ->constrained('categories')
                  ->onDelete('cascade');
            
            // Chave estrangeira para o usuário que registrou o documento
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            
            // Timestamps padrão do Laravel
            $table->timestamps();
            
            // Soft delete
            $table->softDeletes();
            
            // Índices para otimização
            $table->index('categoria_id');
            $table->index('user_id');
            $table->index('status');
        });
    }

    /**
     * Reverte as migrações - remove a tabela de documentos.
     */
    public function down()
    {
        // Remove as chaves estrangeiras primeiro
        Schema::table('documentos', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropForeign(['user_id']);
        });
        
        // Remove a tabela
        Schema::dropIfExists('documentos');
    }
}