<?php
// database/migrations/2023_01_01_000000_create_nivels_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNivelsTable extends Migration
{
    public function up()
    {
        Schema::create('nivels', function (Blueprint $table) {
            $table->id(); // Cria coluna 'id' auto-incremento, chave primária
            $table->string('nome', 100); // Nome do nível (ex: Técnico, Graduação)
            $table->timestamps(); // Cria 'created_at' e 'updated_at'
            $table->softDeletes(); // Cria 'deleted_at' para soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('nivels'); // Reverte a migration
    }
}